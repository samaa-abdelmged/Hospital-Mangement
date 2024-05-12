<?php

namespace App\Repository\Finance;

use App\Interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FundAccounts;
use App\Models\Patient;
use App\Models\PatientAccounts;
use App\Models\RecieptAccount;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    public function index()
    {

        $receipts = RecieptAccount::all();
        return view('Dashboard.Receipt.index', compact('receipts'));
    }

    public function create()
    {
        $Patients = Patient::all();
        return view('Dashboard.Receipt.add', compact('Patients'));
    }

    public function show($id)
    {
        $receipt = RecieptAccount::findorfail($id);
        return view('Dashboard.Receipt.print', compact('receipt'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        // store receipt_accounts
        $receipt_accounts = new RecieptAccount();
        $receipt_accounts->date = date('y-m-d');
        $receipt_accounts->patient_id = $request->patient_id;
        $receipt_accounts->amount = $request->Debit;
        $receipt_accounts->description = $request->description;
        $receipt_accounts->save();
        // store fund_accounts
        $fund_accounts = new FundAccounts();
        $fund_accounts->date = date('y-m-d');
        $fund_accounts->receipt_id = $receipt_accounts->id;
        $fund_accounts->Debit = $request->Debit;
        $fund_accounts->credit = 0.00;
        $fund_accounts->save();
        // store patient_accounts
        $patient_accounts = new PatientAccounts();
        $patient_accounts->date = date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->receipt_id = $receipt_accounts->id;
        $patient_accounts->Debit = 0.00;
        $patient_accounts->credit = $request->Debit;
        $patient_accounts->save();

        DB::commit();
        session()->flash('add');
        return redirect()->route('Receipt.index');

    }

    public function edit($id)
    {
        $receipt_accounts = RecieptAccount::findorfail($id);
        $Patients = Patient::all();
        return view('Dashboard.Receipt.edit', compact('receipt_accounts', 'Patients'));
    }

    public function update($request)
    {
        DB::beginTransaction();


        // store receipt_accounts
        $receipt_accounts = RecieptAccount::findorfail($request->id);
        $receipt_accounts->date = date('y-m-d');
        $receipt_accounts->patient_id = $request->patient_id;
        $receipt_accounts->amount = $request->Debit;
        $receipt_accounts->description = $request->description;
        $receipt_accounts->save();
        // store fund_accounts
        $fund_accounts = FundAccounts::where('receipt_id', $request->id)->first();
        $fund_accounts->date = date('y-m-d');
        $fund_accounts->receipt_id = $receipt_accounts->id;
        $fund_accounts->Debit = $request->Debit;
        $fund_accounts->credit = 0.00;
        $fund_accounts->save();
        // store patient_accounts
        $patient_accounts = PatientAccounts::where('receipt_id', $request->id)->first();
        $patient_accounts->date = date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->receipt_id = $receipt_accounts->id;
        $patient_accounts->Debit = 0.00;
        $patient_accounts->credit = $request->Debit;
        $patient_accounts->save();

        DB::commit();
        session()->flash('edit');
        return redirect()->route('Receipt.index');

    }

    public function destroy($request)
    {
        try {
            RecieptAccount::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}