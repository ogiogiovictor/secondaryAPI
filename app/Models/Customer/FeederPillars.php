<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeederPillars extends Model
{
    use HasFactory;

    protected $table = "EMS_ZONE.dbo.FeederPillars";

    protected $connection = 'zone_connection';

    public $timestamps = false;
}
