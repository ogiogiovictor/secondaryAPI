<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECMIPayment extends Model
{
    use HasFactory;

    protected $table = "ECMI.dbo.Transactions";

    protected $connection = 'ecmi_prod';

    public $timestamps = false;
}
