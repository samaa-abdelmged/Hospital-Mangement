<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewInvoice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $patient;
    public $invoice_id;
    public $doctor_id;
    public $message;
    public $created_at;

    public function __construct($data)
    {
        $patient = Patient::find($data['patient']);
        $this->patient = $patient->name;
        $this->doctor_id = $data['doctor_id'];
        $this->invoice_id = $data['invoice_id'];
        $this->message = "كشف جديد : ";
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('new-invoice.' . $this->doctor_id);
    }

    public function broadcastAs()
    {
        return 'new-invoice';
    }

}