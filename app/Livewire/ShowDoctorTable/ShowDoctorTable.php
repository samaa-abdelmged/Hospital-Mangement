<?php

namespace App\Livewire\ShowDoctorTable;

use App\Models\Doctor;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ShowDoctorTable extends Component
{

    public $doctors, $doctor_id, $section_id, $id;

    public function render()
    {
        return view('livewire.ShowDoctorTable.show-doctor-table');
    }

    public function mount()
    {
        $this->doctors = Doctor::get();
    }

    public function get_section()
    {

        $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
        $this->section_id = $doctor_id->section->name;
        $this->id = Doctor::findorfail($this->doctor_id);
    }


}