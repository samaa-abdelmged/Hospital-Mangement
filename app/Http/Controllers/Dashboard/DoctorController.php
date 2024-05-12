<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    private $Doctors;

    public function __construct(DoctorRepositoryInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }

    public function index()
    {
        return $this->Doctors->index();
    }

    public function create()
    {
        return $this->Doctors->create();
    }

    public function store(StoreDoctorRequest $request)
    {
        return $this->Doctors->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }

    public function update(UpdateDoctorRequest $request)
    {
        return $this->Doctors->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Doctors->destroy($request);
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        return $this->Doctors->update_password($request);
    }

    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->Doctors->update_status($request);
    }

    public function DoctorTable($id)
    {
        return $this->Doctors->DoctorTable($id);
    }


}