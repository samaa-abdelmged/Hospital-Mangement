<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccounts extends Model
{
    protected $guarded = [];

    use HasFactory;
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function ReceiptAccount()
    {
        return $this->belongsTo(RecieptAccount::class, 'receipt_id');
    }

    public function PaymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class, 'Payment_id');
    }
}