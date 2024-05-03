<?php

namespace App\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Create extends Component
{
    public $doctors, $name, $email, $phone, $appointment_patient, $notes, $doctor_id, $section_id;
    protected $rules = [

        'name' => 'required|max:30',
        'email' => 'required|email|unique:appointments',
        'section_id' => 'required',
        'doctor_id' => "required",
        'phone' => 'required|unique:appointments',
        'appointment_patient' => 'required',
    ];

    protected $messages = [

        'name.required' => 'The field cannot be empty',
        'name.max:30' => 'The field cannot be max 30 letters',
        'email.required' => 'The field cannot be empty.',
        'email.unique' => 'The email has taken before',
        'email.email' => 'The email is not right',
        'section_id.required' => 'The field cannot be empty.',
        'doctor_id.required' => 'The field cannot be empty.',
        'phone.required' => 'The field cannot be empty.',
        'phone.unique' => 'The phone has taken before',
        'appointment_patient.required' => 'choose you appointment',

    ];

    public function mount()
    {
        $this->doctors = Doctor::get();
    }
    public function render()
    {
        return view('livewire.appointments.create');
    }



    public function get_section()
    {

        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
    }

    public function store()
    {
        if ($this->validate()) {

            //chek number_of_statements
            $appointment_count = Appointment::where('doctor_id', $this->doctor_id)->where('type', 'غير مؤكد')->where('appointment', $this->appointment_patient)->count();
            $doctor_info = Doctor::find($this->doctor_id);

            if ($appointment_count == $doctor_info->number_of_statements) {
                session()->flash('error', trans('website/appointments.no_appointement'));
            } else {
                $appointments = new Appointment();
                $appointments->doctor_id = $this->doctor_id;
                $appointments->section_id = DB::table('section_translations')->where('name', $this->section_id)->first()->section_id;
                $appointments->name = $this->name;
                $appointments->email = $this->email;
                $appointments->phone = $this->phone;
                $appointments->appointment = $this->appointment_patient;
                $appointments->notes = $this->notes;
                $appointments->save();
                return session()->flash('alert', trans('website/appointments.successful_message'));

            }
        }
    }
}