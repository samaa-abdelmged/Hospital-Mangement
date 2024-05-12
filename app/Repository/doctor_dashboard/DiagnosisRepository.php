<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use App\Models\Diagnostic;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    public function store($request)
    {
        DB::beginTransaction();

        $this->invoice_status($request->invoice_id, 3);
        $diagnosis = new Diagnostic();
        $diagnosis->date = date('Y-m-d');
        $diagnosis->diagnosis = $request->diagnosis;
        $diagnosis->medicine = $request->medicine;
        $diagnosis->invoice_id = $request->invoice_id;
        $diagnosis->patient_id = $request->patient_id;
        $diagnosis->doctor_id = $request->doctor_id;
        $diagnosis->save();

        DB::commit();
        session()->flash('add');
        return redirect()->back();

    }

    public function show($id)
    {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        return view('Dashboard.doctor_dashboard.invoices.patient_record', compact('patient_records'));
    }

    public function addReview($request)
    {
        DB::beginTransaction();

        $this->invoice_status($request->invoice_id, 2);
        $diagnosis = new Diagnostic();
        $diagnosis->date = date('Y-m-d');
        $diagnosis->review_date = date('Y-m-d H:i:s');
        $diagnosis->diagnosis = $request->diagnosis;
        $diagnosis->medicine = $request->medicine;
        $diagnosis->invoice_id = $request->invoice_id;
        $diagnosis->patient_id = $request->patient_id;
        $diagnosis->doctor_id = $request->doctor_id;
        $diagnosis->save();

        DB::commit();
        session()->flash('add');
        return redirect()->back();

    }

    public function invoice_status($invoice_id, $id_status)
    {
        $invoice_status = Invoice::findorFail($invoice_id);
        $invoice_status->update([
            'invoice_status' => $id_status,
        ]);
    }

}