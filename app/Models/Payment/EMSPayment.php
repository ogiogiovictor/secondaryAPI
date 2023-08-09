<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMSPayment extends Model
{
    use HasFactory;

    protected $table = "EMS_ZONE.dbo.Payments";

    protected $connection = 'zone_connection';

    public $timestamps = false;
}
