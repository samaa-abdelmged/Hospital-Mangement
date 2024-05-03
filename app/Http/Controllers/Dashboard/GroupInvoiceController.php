<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class GroupInvoiceController extends Controller
{
    public function CallComponent()
    {
        return view('livewire.GroupInvoices.index');
    }

}