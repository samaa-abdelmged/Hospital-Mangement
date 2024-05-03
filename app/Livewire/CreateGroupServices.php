<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Service;
use App\Models\ServiceGroup;
use Livewire\Component;

class CreateGroupServices extends Component
{
    public $allServices = [];

    public $group_id, $service_group_id;
    public $GroupsItems = [];

    public $discount_value = 0, $taxes = 17, $name_group, $notes, $total, $Total_after_discount, $Total_with_tax;
    public $ServiceSaved = false, $ServiceUpdated = false, $updateMode = false;

    public function render()
    {
        return view('livewire.GroupServices.create-group-services', [
            'groups' => Group::all(),
        ]);

    }

    public function mount()
    {
        $this->allServices = Service::all();

    }
    public function updateValues()
    {
        $this->Total_with_tax = ($this->total - (is_numeric($this->discount_value) ? $this->discount_value : 0)) * (1 - (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
    }

    public function addService()
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'save_data' => false,
            'service_name' => '',
            'service_price' => 0,
        ];

        $this->ServiceSaved = false;
    }

    public function editService($index)
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }
        $this->removeService($index);
        $this->GroupsItems[$index]['is_saved'] = false;

    }

    public function saveService($index)
    {
        $this->resetErrorBag();

        $product = $this->allServices->find($this->GroupsItems[$index]['service_id']);
        $this->GroupsItems[$index]['service_name'] = $product->name;
        $this->GroupsItems[$index]['service_price'] = $product->price;
        $this->GroupsItems[$index]['is_saved'] = true;
        $this->GroupsItems[$index]['save_data'] = false;
        foreach ($this->GroupsItems as $groupItem) {
            if (array_key_exists('service_id', $this->GroupsItems[$index])) {
                $p = $this->GroupsItems[$index]['service_price'] * $this->GroupsItems[$index]['quantity'];
                $this->total += $p;
                break;
            }
        }
    }

    public function removeService($index)
    {

        foreach ($this->GroupsItems as $groupItem) {
            if (array_key_exists('service_id', $this->GroupsItems[$index])) {
                $this->total -= $this->GroupsItems[$index]['service_price'] * $this->GroupsItems[$index]['quantity'];

                ServiceGroup::where([
                    'Group_id' => $this->service_group_id,
                    'Service_id' => $this->GroupsItems[$index]['service_id'],
                    'quantity' => $this->GroupsItems[$index]['quantity'],
                ])->delete();
                unset($this->GroupsItems[$index]);
                $this->GroupsItems = array_values($this->GroupsItems);
                break;
            }
        }

    }

    public function edit($id)
    {
        $group = Group::where('id', $id)->first();

        $this->group_id = $id;
        $this->reset('GroupsItems', 'name_group', 'notes', 'Total_after_discount', 'discount_value', 'taxes', 'total', 'Total_with_tax');
        $this->name_group = $group->name;
        $this->notes = $group->notes;
        $this->total = $group->Total_before_discount;
        $this->discount_value = $group->discount_value;
        $this->Total_after_discount = $group->Total_after_discount;
        $this->taxes = $group->tax_rate;
        $this->Total_with_tax = $group->Total_with_tax;

        $quantity_array = [];
        $service_group = ServiceGroup::where(['Group_id' => $id])->get();
        foreach ($service_group as $row) {
            $quantity_array[] = $row->quantity;
        }
        $index = 0;
        foreach ($group->service_group as $serviceGroup) {
            $this->GroupsItems[] = [
                'service_id' => $serviceGroup->id,
                'quantity' => $quantity_array[$index],
                'is_saved' => true,
                'save_data' => true,
                'service_name' => $serviceGroup->name,
                'service_price' => $serviceGroup->price,
                $index++,
            ];
        }
        $this->service_group_id = $id;
        $this->updateMode = true;
    }

    public function saveGroup()
    {
        if ($this->updateMode) {
            $this->update_group();
            $this->ServiceUpdated = true;
        } else {
            $this->save_group();
            $this->ServiceSaved = true;

        }
    }

    public function delete($id)
    {

        $this->group_id = $id;

    }
    public function destroy()
    {
        foreach (ServiceGroup::all() as $groupItem) {
            $groupItem::where([
                'Group_id' => $this->group_id,
            ])->delete();
        }
        Group::destroy($this->group_id);
        return session()->flash('delete', "تم الحذف بنجاح");
    }

    public function save_group()
    {
        $Groups = new Group();

        //الاجمالي قبل الخصم
        $Groups->Total_before_discount = $this->total;
        // قيمة الخصم
        $Groups->discount_value = $this->discount_value;
        // الاجمالي بعد الخصم
        $Groups->Total_after_discount = $this->total - $this->discount_value;
        //  نسبة الضريبة
        $Groups->tax_rate = $this->taxes;
        // الاجمالي + الضريبة
        $Groups->Total_with_tax = $this->Total_with_tax;
        $Groups->save();

        // حفظ الترجمة
        $Groups->name = $this->name_group;
        $Groups->notes = $this->notes;
        $Groups->save();

        // حفظ العلاقة
        foreach ($this->GroupsItems as $GroupsItem) {
            $services_group = new ServiceGroup();
            $services_group->quantity = $GroupsItem['quantity'];
            $services_group->Group_id = Group::latest('id')->first()->id;
            $services_group->Service_id = $GroupsItem['service_id'];
            $services_group->save();

        }

        $this->reset('GroupsItems', 'name_group', 'notes', 'Total_after_discount', 'discount_value', 'taxes', 'total', 'Total_with_tax');

    }

    public function update_group()
    {
        $Groups = Group::find($this->group_id);
        //الاجمالي قبل الخصم
        $Groups->Total_before_discount = $this->total;
        // قيمة الخصم
        $Groups->discount_value = $this->discount_value;
        // الاجمالي بعد الخصم
        $Groups->Total_after_discount = $this->total - $this->discount_value;
        //  نسبة الضريبة
        $Groups->tax_rate = $this->taxes;
        // الاجمالي + الضريبة
        $Groups->Total_with_tax = $this->Total_with_tax;
        $Groups->save();

        // حفظ الترجمة
        $Groups->name = $this->name_group;
        $Groups->notes = $this->notes;
        $Groups->save();

        // حفظ العلاقة

        foreach ($this->GroupsItems as $GroupsItem) {
            if ($GroupsItem['save_data'] == false) {
                $services_group = new ServiceGroup();
                $services_group->quantity = $GroupsItem['quantity'];
                $services_group->Group_id = Group::latest('id')->first()->id;
                $services_group->Service_id = $GroupsItem['service_id'];
                $services_group->save();
            }
        }

        $this->reset('GroupsItems', 'name_group', 'notes', 'Total_after_discount', 'discount_value', 'taxes', 'total', 'Total_with_tax');

    }
}