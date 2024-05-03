<?php

namespace App\Repository\Dashboard_Employee\Invoices;

use App\Interfaces\Dashboard_Employee\Invoices\InvoicesRepositoryInterface;
use App\Models\Ray;
use App\Traits\UploadTrait;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        if (auth()->user()->section === 1) {
            $invoices = Ray::where('case', 0)->get();
            return view('Dashboard.employee_dashboard.invoices.index', compact('invoices'));
        }
        return redirect()->route('404');

    }

    public function edit($id)
    {
        if (auth()->user()->section === 1) {
            $invoice = Ray::find($id);
            if ($invoice->where('employee_id', auth()->user()->ray_employee_id)) {
                return view('Dashboard.employee_dashboard.invoices.add_diagnosis', compact('invoice'));
            }
        }
        return redirect()->route('404');

    }

    public function update($request, $id)
    {
        if (auth()->user()->section === 1) {

            $invoice = Ray::find($id);
            if ($invoice->where('employee_id', auth()->user()->ray_employee_id)) {
                $invoice->update([
                    'employee_id' => auth()->user()->ray_employee_id,
                    'description_employee' => $request->description_employee,
                    'case' => 1,
                ]);
                //Upload img
                $this->verifyAndStoreImage($request, 'photos', 'Rays', 'upload_image', auth()->user()->ray_employee_id, 'App\Models\Ray');
                session()->flash('edit');
                return redirect()->route('employee_invoices.index');
            }
        }
        return redirect()->route('404');

/*
if ($request->hasFile('photos')) {

foreach ($request->photos as $photo) {
//Upload img
$this->verifyAndStoreImage($photo, 'photo', 'Rays', 'upload_image', $invoice->id, 'App\Models\Ray');
}

}
 */

    }
    public function completed_invoices()
    {
        $invoices = Ray::where('case', 1)->where('employee_id', auth()->user()->ray_employee_id)->get();
        return view('Dashboard.employee_dashboard.invoices.completed_invoices', compact('invoices'));

    }

    public function view_Rays($id)
    {
        if (auth()->user()->section === 1) {
            $rays = Ray::findorFail($id);
            if ($rays->employee_id == auth()->user()->ray_employee_id) {
                return view('Dashboard.employee_dashboard.invoices.patient_details', compact('rays'));
            }
        }
        return redirect()->route('404');

    }
}