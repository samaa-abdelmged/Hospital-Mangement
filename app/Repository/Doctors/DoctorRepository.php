<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add', compact('sections', 'appointments'));
    }

    public function store($request)
    {

        DB::beginTransaction();


        $doctors = new Doctor();
        $doctors->email = $request->email;
        $doctors->password = Hash::make($request->password);
        $doctors->section_id = $request->section_id;
        $doctors->phone = $request->phone;
        $doctors->status = 1;
        $doctors->day_start = array(
            '1' => '00:00',
            '2' => '00:00',
            '3' => '00:00',
            '4' => '00:00',
            '5' => '00:00',
            '6' => '00:00',
            '7' => '00:00',
        );
        $doctors->day_end = array(
            '1' => '00:00',
            '2' => '00:00',
            '3' => '00:00',
            '4' => '00:00',
            '5' => '00:00',
            '6' => '00:00',
            '7' => '00:00',
        );

        $doctors->save();
        // store trans
        $doctors->name = $request->name;
        $doctors->save();

        //Upload img
        $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctors->id, 'App\Models\Doctor');

        DB::commit();
        session()->flash('add');
        return redirect()->route('Doctors.create');

        DB::rollback();


    }

    public function update($request)
    {
        DB::beginTransaction();

        $doctor = Doctor::findorfail($request->id);

        $doctor->email = $request->email;
        $doctor->section_id = $request->section_id;
        $doctor->phone = $request->phone;


        $doctor->day_start = [
            '1' => $request->day_start_1,
            '2' => $request->day_start_2,
            '3' => $request->day_start_3,
            '4' => $request->day_start_4,
            '5' => $request->day_start_5,
            '6' => $request->day_start_6,
            '7' => $request->day_start_7,

        ];
        $doctor->day_end = [
            '1' => $request->day_end_1,
            '2' => $request->day_end_2,
            '3' => $request->day_end_3,
            '4' => $request->day_end_4,
            '5' => $request->day_end_5,
            '6' => $request->day_end_6,
            '7' => $request->day_end_7,
        ];

        $doctor->save();
        // store trans
        $doctor->name = $request->name;
        $doctor->save();

        // update pivot tABLE

        // update photo
        if ($request->has('photo')) {
            // Delete old photo
            if ($doctor->image) {
                $old_img = $doctor->image->filename;
                $this->Delete_attachment('upload_image', 'doctors/' . $old_img, $request->id);
            }
            //Upload img
            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $request->id, 'App\Models\Doctor');
        }

        DB::commit();
        session()->flash('edit');
        return redirect()->back();


    }

    public function destroy($request)
    {
        if ($request->page_id == 1) {

            if ($request->filename) {

                $this->Delete_attachment('upload_image', 'doctors/' . $request->filename, $request->id, $request->filename);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }

        //---------------------------------------------------------------
        else {

            // delete selector doctor
            $delete_select_id = explode(",", $request->delete_select_id);
            foreach ($delete_select_id as $ids_doctors) {
                $doctor = Doctor::findorfail($ids_doctors);
                if ($doctor->image) {
                    $this->Delete_attachment('upload_image', 'doctors/' . $doctor->image->filename, $ids_doctors, $doctor->image->filename);
                }
            }

            Doctor::destroy($delete_select_id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }

    }

    public function edit($id)
    {
        $sections = Section::all();
        $doctor = Doctor::findorfail($id);
        return view('Dashboard.Doctors.edit', compact('sections', 'doctor'));
    }

    public function update_password($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'password' => Hash::make($request->password),
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status($request)
    {
        try {
            $doctor = Doctor::findorfail($request->id);
            $doctor->update([
                'status' => $request->status,
            ]);

            session()->flash('edit');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function DoctorTable($id)
    {
        $doctor = Doctor::findorfail($id);
        return view('Dashboard.Doctors.table', compact('doctor'));
    }



}