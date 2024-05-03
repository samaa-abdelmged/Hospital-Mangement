<?php

namespace App\Interfaces\Dashboard_Employee\Invoices;

interface InvoicesRepositoryInterface
{
    public function index();
    public function completed_invoices();
    public function edit($id);
    public function update($request, $id);
    public function view_Rays($id);
}