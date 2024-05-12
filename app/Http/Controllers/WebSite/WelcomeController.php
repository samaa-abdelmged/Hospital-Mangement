<?php

namespace App\Http\Controllers\WebSite;

use App\Models\Doctor;
use App\Models\Section;
use App\Models\Service;
use App\Models\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{


    public function CallComponent()
    {
        $id = null;
        return view('livewire.ShowDoctorTable.index', compact('id'));

    }

    public function ShowServices()
    {
        $groups = Group::all();
        $services = Service::all();
        return view('WebSite.ShowServices.show_services', compact('groups', 'services'));
    }

    public function ShowDoctors()
    {
        $doctors = Doctor::get();
        return view('WebSite.ShowDoctors.show_doctors', compact('doctors'));
    }

    public function ShowSections()
    {
        $sections = Section::get();
        return view('WebSite.ShowSections.show_sections', compact('sections'));
    }
}