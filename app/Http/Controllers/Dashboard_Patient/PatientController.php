<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_Patient\PatientProcessesRepositoryInterface;

class PatientController extends Controller
{

    private $process;

    public function __construct(PatientProcessesRepositoryInterface $process)
    {
        $this->process = $process;
    }
    public function invoices()
    {
        return $this->process->invoices();
    }public function laboratories()
    {
        return $this->process->laboratories();
    }public function viewLaboratories($id)
    {
        return $this->process->viewLaboratories($id);
    }public function rays()
    {
        return $this->process->rays();
    }public function viewRays($id)
    {
        return $this->process->viewRays($id);
    }
    public function payments()
    {
        return $this->process->payments();
    }

}