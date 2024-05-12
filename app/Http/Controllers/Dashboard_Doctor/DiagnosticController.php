<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDiagnosticDoctorRequest;
use App\Http\Requests\AddReviewRequest;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{

    private $Diagnosis;

    public function __construct(DiagnosisRepositoryInterface $Diagnosis)
    {
        $this->Diagnosis = $Diagnosis;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(AddDiagnosticDoctorRequest $request)
    {
        return $this->Diagnosis->store($request);
    }

    public function addReview(AddReviewRequest $request)
    {
        return $this->Diagnosis->addReview($request);
    }

    public function show($id)
    {
        return $this->Diagnosis->show($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}