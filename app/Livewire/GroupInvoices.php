<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\FundAccounts;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccounts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class GroupInvoices extends Component
{
    public $type, $tax_rate, $tax_value, $price, $subtotal, $discount_value = 0, $taxes = 17;
    public $InvoiceSaved = false, $InvoiceUpdated = false, $updateMode = false;
    public $invoice_id, $Group_id;
    public $patient_id, $doctor_id, $section_id;


    protected $rules = [

        'patient_id' => 'required',
        'doctor_id' => 'required',
        'type' => "required",
        'Group_id' => 'required',
        'discount_value' => 'required|numeric',
        'tax_rate' => 'required|numeric',
    ];

    protected $messages = [

        'patient_id.required' => 'select the patient',
        'doctor_id.required' => 'select the doctor',
        'type.required' => 'select the type of invoice',
        'Group_id.required' => 'select the service',
        'discount_value.required' => 'type the discount value',
        'tax_rate.required' => 'type the tax rate',
        'discount_value.numeric' => 'type numbers only',
        'tax_rate.numeric' => 'type numbers only',

    ];

    public function render()
    {
        return view('livewire.GroupInvoices.group-invoices', [
            'invoices' => Invoice::where('invoice_type', 2)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Groups' => Group::all(),

        ]);
    }

    public function updateValues()
    {

        $this->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $this->subtotal = ($this->price - $this->discount_value) - $this->tax_value;

    }

    public function get_section()
    {
        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price()
    {
        $this->price = Group::where('id', $this->Group_id)->first()->Total_before_discount;
        $this->discount_value = Group::where('id', $this->Group_id)->first()->discount_value;
        $this->tax_rate = Group::where('id', $this->Group_id)->first()->tax_rate;
        $this->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $this->subtotal = ($this->price - $this->discount_value) + $this->tax_value;

    }

    public function store()
    {

        // في حالة كانت الفاتورة نقدي
        if ($this->type == 1) {

            // في حالة التعديل
            if ($this->updateMode) {
                $this->EditDebit();
                $this->reset('type', 'tax_rate', 'tax_value', 'price', 'subtotal', 'discount_value', 'taxes', 'patient_id', 'doctor_id', 'section_id');
                $this->InvoiceUpdated = true;
                $this->updateMode = false;
            }

            // في حالة الاضافة
            else {
                $this->SaveDebit();
                $this->reset('type', 'tax_rate', 'tax_value', 'price', 'subtotal', 'discount_value', 'taxes', 'patient_id', 'doctor_id', 'section_id');
                $this->InvoiceSaved = true;
                $this->updateMode = false;

            }

        }

        //----------------------------------------------------------------------------------------------------

        // في حالة الفاتورة اجل
        else {


            // في حالة التعديل
            if ($this->updateMode) {

                $this->EditCredit();
                $this->reset('type', 'tax_rate', 'tax_value', 'price', 'subtotal', 'discount_value', 'taxes', 'patient_id', 'doctor_id', 'section_id');
                $this->InvoiceUpdated = true;
                $this->updateMode = false;

            }

            // في حالة الاضافة
            else {
                $this->SaveCredit();
                $this->reset('type', 'tax_rate', 'tax_value', 'price', 'subtotal', 'discount_value', 'taxes', 'patient_id', 'doctor_id', 'section_id');
                $this->InvoiceSaved = true;
                $this->updateMode = false;

            }


        }
    }

    public function edit($id)
    {

        $group_invoices = Invoice::findorfail($id);
        $this->invoice_id = $group_invoices->id;
        $this->patient_id = $group_invoices->patient_id;
        $this->doctor_id = $group_invoices->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $group_invoices->section_id)->first()->name;
        $this->Group_id = $group_invoices->Group_id;
        $this->price = $group_invoices->price;
        $this->discount_value = $group_invoices->discount_value;
        $this->taxes = $group_invoices->tax_rate;
        $this->tax_value = $group_invoices->tax_value;
        $this->tax_rate = $group_invoices->tax_rate;
        $this->subtotal = $group_invoices->total_with_tax;
        $this->type = $group_invoices->type;
        $this->updateMode = true;
    }

    public function SaveDebit()
    {
        if ($this->validate()) {


            $group_invoices = new Invoice();
            $group_invoices->invoice_type = 2;
            $group_invoices->invoice_date = date('Y-m-d');
            $group_invoices->patient_id = $this->patient_id;
            $group_invoices->doctor_id = $this->doctor_id;
            $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $group_invoices->Group_id = $this->Group_id;
            $group_invoices->price = $this->price;
            $group_invoices->discount_value = $this->discount_value;
            $group_invoices->tax_rate = $this->tax_rate;
            $group_invoices->tax_value = $this->tax_value;
            $group_invoices->total_with_tax = $this->subtotal;
            $group_invoices->type = $this->type;
            $group_invoices->save();

            $fund_accounts = new FundAccounts();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->invoice_id = $group_invoices->id;
            $fund_accounts->Debit = $group_invoices->total_with_tax;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
        }
    }

    public function EditDebit()
    {
        if ($this->validate()) {

            $group_invoices = Invoice::findorfail($this->invoice_id);
            $group_invoices->invoice_type = 2;
            $group_invoices->invoice_date = date('Y-m-d');
            $group_invoices->patient_id = $this->patient_id;
            $group_invoices->doctor_id = $this->doctor_id;
            $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $group_invoices->Group_id = $this->Group_id;
            $group_invoices->price = $this->price;
            $group_invoices->discount_value = $this->discount_value;
            $group_invoices->tax_rate = $this->tax_rate;
            $group_invoices->tax_value = $this->tax_value;
            $group_invoices->total_with_tax = $this->subtotal;
            $group_invoices->type = $this->type;
            $group_invoices->save();

            $fund_accounts = FundAccounts::where('invoice_id', $this->invoice_id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->invoice_id = $group_invoices->id;
            $fund_accounts->Debit = $group_invoices->total_with_tax;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
        }
    }

    public function SaveCredit()
    {
        if ($this->validate()) {

            $group_invoices = new Invoice();
            $group_invoices->invoice_date = date('Y-m-d');
            $group_invoices->invoice_type = 2;
            $group_invoices->patient_id = $this->patient_id;
            $group_invoices->doctor_id = $this->doctor_id;
            $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $group_invoices->Group_id = $this->Group_id;
            $group_invoices->price = $this->price;
            $group_invoices->discount_value = $this->discount_value;
            $group_invoices->tax_rate = $this->tax_rate;
            $group_invoices->tax_value = $this->tax_value;
            $group_invoices->total_with_tax = $this->subtotal;
            $group_invoices->type = $this->type;
            $group_invoices->save();

            $patient_accounts = new PatientAccounts();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->invoice_id = $group_invoices->id;
            $patient_accounts->patient_id = $group_invoices->patient_id;
            $patient_accounts->Debit = $group_invoices->total_with_tax;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();
        }
    }
    public function EditCredit()
    {
        if ($this->validate()) {

            $group_invoices = Invoice::findorfail($this->invoice_id);
            $group_invoices->invoice_type = 2;
            $group_invoices->invoice_date = date('Y-m-d');
            $group_invoices->patient_id = $this->patient_id;
            $group_invoices->doctor_id = $this->doctor_id;
            $group_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $group_invoices->Group_id = $this->Group_id;
            $group_invoices->price = $this->price;
            $group_invoices->discount_value = $this->discount_value;
            $group_invoices->tax_rate = $this->tax_rate;
            $group_invoices->tax_value = $this->tax_value;
            $group_invoices->total_with_tax = $this->subtotal;
            $group_invoices->type = $this->type;
            $group_invoices->save();

            $patient_accounts = PatientAccounts::where('invoice_id', $this->invoice_id)->first();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->invoice_id = $group_invoices->id;
            $patient_accounts->patient_id = $group_invoices->patient_id;
            $patient_accounts->Debit = $group_invoices->total_with_tax;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();
        }
    }
    public function delete($id)
    {
        $this->invoice_id = $id;
    }

    public function destroy()
    {
        Invoice::destroy($this->invoice_id);
        return redirect()->route('GroupInvoice')->with('delete', "تم الحذف بنجاح");

    }

    public function print($id)
    {
        $group_invoice = Invoice::findorfail($id);
        return Redirect::route('group_invoices_Print', [
            'invoice_date' => $group_invoice->invoice_date,
            'patient_id' => $group_invoice->Patient->name,
            'doctor_id' => $group_invoice->Doctor->name,
            'section_id' => $group_invoice->Section->name,
            'Group_id' => $group_invoice->Group->name,
            'type' => $group_invoice->type,
            'price' => $group_invoice->price,
            'discount_value' => $group_invoice->discount_value,
            'tax_rate' => $group_invoice->tax_rate,
            'total_with_tax' => $group_invoice->total_with_tax,
        ]);

    }

}