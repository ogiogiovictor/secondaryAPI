<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $table = "EMS_ZONE.dbo.Tariff";

    protected $connection = 'zone_connection';

    public $timestamps = false;
}
