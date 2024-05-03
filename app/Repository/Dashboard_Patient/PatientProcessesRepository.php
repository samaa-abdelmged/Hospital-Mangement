<?php

namespace App\Repository\Dashboard_Patient;

use App\Interfaces\Dashboard_Patient\PatientProcessesRepositoryInterface;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\RecieptAccount;

class PatientProcessesRepository implements PatientProcessesRepositoryInterface
{
    public function invoices()
    {

        $invoices = Invoice::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patient_dashboard.patient_processes.invoices', compact('invoices'));
    }

    public function laboratories()
    {

        $laboratories = Laboratorie::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patient_dashboard.patient_processes.laboratories', compact('laboratories'));
    }

    public function viewLaboratories($id)
    {

        $laboratorie = Laboratorie::findorFail($id);
        if ($laboratorie->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.employee_dashboard.invoices_laboratorie.patient_details', compact('laboratorie'));
    }

    public function rays()
    {

        $rays = Ray::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patient_dashboard.patient_processes.rays', compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if ($rays->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.employee_dashboard.invoices.patient_details', compact('rays'));
    }

    public function payments()
    {

        $payments = RecieptAccount::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patient_dashboard.patient_processes.payments', compact('payments'));
    }

}