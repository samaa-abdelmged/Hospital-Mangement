<?php

namespace App\Interfaces\Dashboard_Patient;

interface PatientProcessesRepositoryInterface
{
    public function invoices();
    public function laboratories();
    public function viewLaboratories($id);
    public function rays();
    public function viewRays($id);
    public function payments();
}