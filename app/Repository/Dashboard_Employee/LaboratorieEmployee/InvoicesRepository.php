<?php

namespace App\Repository\Dashboard_Employee\LaboratorieEmployee;

use App\Interfaces\Dashboard_Employee\LaboratorieEmployee\InvoicesRepositoryInterface;
use App\Models\Laboratorie;
use App\Traits\UploadTrait;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    use UploadTrait;

    public function index()
    {
        $invoices = Laboratorie::where('case', 0)->get();
        return view('Dashboard.employee_dashboard.invoices_laboratorie.index', compact('invoices'));

    }

    public function completed_invoices()
    {
        if (auth()->user()->section === 2) {
            $invoices = Laboratorie::where('case', 1)->where('employee_id', auth()->user()->laboratorie_employee_id)->get();
            return view('Dashboard.employee_dashboard.invoices_laboratorie.completed_invoices', compact('invoices'));
        }
        return redirect()->route('404');
    }

    public function edit($id)
    {
        if (auth()->user()->section === 2) {
            $invoice = Laboratorie::findorFail($id);
            if ($invoice->laboratorie_employee_id == auth()->user()->laboratorie_employee_id) {
                return view('Dashboard.employee_dashboard.invoices_laboratorie.add_diagnosis', compact('invoice'));
            }
        }
        return redirect()->route('404');
    }

    public function update($request, $id)
    {
        if (auth()->user()->section === 2) {
            $invoice = Laboratorie::findorFail($id);
            if ($invoice->laboratorie_employee_id == auth()->user()->laboratorie_employee_id) {
                $invoice->update([
                    'employee_id' => auth()->user()->laboratorie_employee_id,
                    'description_employee' => $request->description_employee,
                    'case' => 1,
                ]);

                //Upload img
                $this->verifyAndStoreImage($request, 'photos', 'Laboratorie', 'upload_image', auth()->user()->laboratorie_employee_id, 'App\Models\Laboratorie');

                session()->flash('edit');
                return redirect()->route('invoices_laboratorie_employee.index');
            }
        }
        return redirect()->route('404');
    }

    public function view_laboratories($id)
    {
        if (auth()->user()->section === 2) {

            $laboratorie = Laboratorie::findorFail($id);
            if ($laboratorie->employee_id == auth()->user()->laboratorie_employee_id) {
                return view('Dashboard.employee_dashboard.invoices_laboratorie.patient_details', compact('laboratorie'));
            }
        }
        return redirect()->route('404');
    }
}

/*
public function index()
{
if (auth()->user()->section === 2) {
$invoices = Laboratorie::where('case', 0)->where('employee_id', auth()->user()->laboratorie_employee_id)->get();
return view('Dashboard.employee_dashboard.invoices_laboratorie.index', compact('invoices'));
}
return redirect()->route('404');

}

 */