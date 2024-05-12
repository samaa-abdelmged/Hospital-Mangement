<?php

namespace App\Livewire\SingleInvoices;

use App\Events\NewInvoice;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\FundAccounts;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAccounts;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $username;
    public $InvoiceSaved, $InvoiceUpdated, $updateMode = false;
    public $price, $discount_value = 0, $tax_value = 0, $tax_rate = 20, $subtotal = 0;
    public $patient_id, $doctor_id, $section_id, $Service_id, $type, $invoice_id;


    protected $rules = [

        'patient_id' => 'required',
        'doctor_id' => 'required',
        'type' => "required",
        'Service_id' => 'required',
        'discount_value' => 'required|numeric',
        'tax_rate' => 'required|numeric',
    ];

    protected $messages = [

        'patient_name.required' => 'select the patient',
        'doctor_id.required' => 'select the doctor',
        'invoice_type.required' => 'select the type of invoice',
        'Service_id.required' => 'select the service',
        'discount_value.required' => 'type the discount value',
        'tax_rate.required' => 'type the tax rate',
        'discount_value.numeric' => 'type numbers only',
        'tax_rate.numeric' => 'type numbers only',

    ];

    public function mount()
    {

        $this->username = auth()->user()->name;
    }

    public function render()
    {
        return view('livewire.SingleInvoices.single-invoices', [
            'invoices' => Invoice::where('invoice_type', 1)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Services' => Service::all(),
        ]);
    }

    public function get_section()
    {

        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
        $this->updateValues();

    }

    public function print($id)
    {
        $single_invoice = Invoice::findorfail($id);
        return Redirect::route('Print_single_invoices', [
            'invoice_date' => $single_invoice->invoice_date,
            'patient_id' => $single_invoice->Patient->name,
            'doctor_id' => $single_invoice->Doctor->name,
            'section_id' => $single_invoice->Section->name,
            'Service_id' => $single_invoice->Service->name,
            'type' => $single_invoice->type,
            'price' => $single_invoice->price,
            'discount_value' => $single_invoice->discount_value,
            'tax_rate' => $single_invoice->tax_rate,
            'total_with_tax' => $single_invoice->total_with_tax,
        ]);

    }
    public function updateValues()
    {

        $this->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
        $this->subtotal = ($this->price - $this->discount_value) + $this->tax_value;

    }

    public function edit($id)
    {

        $this->updateMode = true;
        $single_invoice = Invoice::findorfail($id);
        $this->invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->section_id = DB::table('section_translations')->where('id', $single_invoice->section_id)->first()->name;
        $this->type = $single_invoice->type;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->tax_value = $single_invoice->tax_value;
        $this->subtotal = $single_invoice->total_with_tax;

    }

    public function store()
    {

        // في حالة كانت الفاتورة نقدي
        if ($this->type == 1) {

            // في حالة التعديل
            if ($this->updateMode) {

                $this->EditDebit();
                $this->InvoiceUpdated = true;

            }

            // في حالة الاضافة
            else {
                $this->SaveDebit();
                $this->InvoiceSaved = true;
            }
        }

        //------------------------------------------------------------------------

        // في حالة كانت الفاتورة اجل
        else {

            // في حالة التعديل
            if ($this->updateMode) {

                $this->EditCredit();
                $this->InvoiceUpdated = true;

            } else {
                $this->SaveCredit();
                $this->InvoiceSaved = true;
            }
        }
    }


    public function delete($id)
    {

        $this->invoice_id = $id;

    }

    public function destroy()
    {
        Invoice::destroy($this->invoice_id);
        return redirect()->to('single_invoices');
    }

    public function SaveDebit()
    {
        if ($this->validate()) {

            $single_invoices = new Invoice();
            $single_invoices->invoice_date = date('Y-m-d');
            $single_invoices->invoice_type = 1;
            $single_invoices->patient_id = $this->patient_id;
            $single_invoices->doctor_id = $this->doctor_id;
            $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $single_invoices->Service_id = $this->Service_id;
            $single_invoices->price = $this->price;
            $single_invoices->discount_value = $this->discount_value;
            $single_invoices->tax_rate = $this->tax_rate;
            $single_invoices->tax_value = $this->tax_value;
            $single_invoices->total_with_tax = $this->subtotal;
            $single_invoices->type = $this->type;
            $single_invoices->invoice_status = 1;
            $single_invoices->save();

            $fund_accounts = new FundAccounts();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->invoice_id = $single_invoices->id;
            $fund_accounts->Debit = $single_invoices->total_with_tax;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();

            //////////////////////////////////////////////////////////////////
            $patient = Patient::find($this->patient_id);
            $appointment_info = Appointment::where('doctor_id', $this->doctor_id)->where('email', $patient->email)->where('type', 'مؤكد')->first();
            if ($appointment_info) {
                $appointment = Appointment::find($appointment_info->id);
                $appointment->update([
                    'type' => 'منتهي'
                ]);
            }

            ///////////////////////////////////////////////
            $notifications = new Notification();
            $notifications->user_id = $this->doctor_id;
            $patient = Patient::find($this->patient_id);
            $notifications->message = "كشف جديد : " . $patient->name;
            $notifications->save();


            $data = [
                'patient' => $this->patient_id,
                'invoice_id' => $single_invoices->id,
                'doctor_id' => $this->doctor_id,
            ];

            event(new NewInvoice($data));
        }
        ///////////////////////////////////////////////
    }

    public function EditDebit()
    {
        if ($this->validate()) {

            $single_invoices = Invoice::findorfail($this->invoice_id);
            $single_invoices->invoice_type = 1;
            $single_invoices->invoice_date = date('Y-m-d');
            $single_invoices->patient_id = $this->patient_id;
            $single_invoices->doctor_id = $this->doctor_id;
            $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $single_invoices->Service_id = $this->Service_id;
            $single_invoices->price = $this->price;
            $single_invoices->discount_value = $this->discount_value;
            $single_invoices->tax_rate = $this->tax_rate;
            $single_invoices->tax_value = $this->tax_value;
            $single_invoices->total_with_tax = $this->subtotal;
            $single_invoices->type = $this->type;
            $single_invoices->save();

            $fund_accounts = FundAccounts::where('invoice_id', $this->invoice_id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->invoice_id = $single_invoices->id;
            $fund_accounts->Debit = $single_invoices->total_with_tax;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
        }
    }

    public function SaveCredit()
    {
        if ($this->validate()) {

            $single_invoices = new Invoice();
            $single_invoices->invoice_type = 1;
            $single_invoices->invoice_date = date('Y-m-d');
            $single_invoices->patient_id = $this->patient_id;
            $single_invoices->doctor_id = $this->doctor_id;
            $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $single_invoices->Service_id = $this->Service_id;
            $single_invoices->price = $this->price;
            $single_invoices->discount_value = $this->discount_value;
            $single_invoices->tax_rate = $this->tax_rate;
            $single_invoices->tax_value = $this->tax_value;
            $single_invoices->total_with_tax = $this->subtotal;
            $single_invoices->type = $this->type;
            $single_invoices->save();

            $patient_accounts = new PatientAccounts();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->invoice_id = $single_invoices->id;
            $patient_accounts->patient_id = $single_invoices->patient_id;
            $patient_accounts->Debit = $single_invoices->total_with_tax;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            ////////////////////////////////////
            // chek appointment
            $patient = Patient::find($this->patient_id);
            $appointment_info = Appointment::where('doctor_id', $this->doctor_id)->where('email', $patient->email)->where('type', 'مؤكد')->first();
            if ($appointment_info) {
                $appointment = Appointment::find($appointment_info->id);
                $appointment->update([
                    'type' => 'منتهي'
                ]);
            }
        }
    }
    public function EditCredit()
    {
        if ($this->validate()) {

            $single_invoices = Invoice::findorfail($this->invoice_id);
            $single_invoices->invoice_type = 1;
            $single_invoices->invoice_date = date('Y-m-d');
            $single_invoices->patient_id = $this->patient_id;
            $single_invoices->doctor_id = $this->doctor_id;
            $single_invoices->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
            $single_invoices->Service_id = $this->Service_id;
            $single_invoices->price = $this->price;
            $single_invoices->discount_value = $this->discount_value;
            $single_invoices->tax_rate = $this->tax_rate;
            $single_invoices->tax_value = $this->tax_value;
            $single_invoices->total_with_tax = $this->subtotal;
            $single_invoices->type = $this->type;
            $single_invoices->save();

            $patient_accounts = PatientAccounts::where('invoice_id', $this->invoice_id)->first();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->invoice_id = $single_invoices->id;
            $patient_accounts->patient_id = $single_invoices->patient_id;
            $patient_accounts->Debit = $single_invoices->total_with_tax;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();
        }

    }
}