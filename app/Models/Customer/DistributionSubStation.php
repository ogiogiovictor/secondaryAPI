<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionSubStation extends Model
{
    use HasFactory;

    protected $table = "EMS_ZONE.dbo.DistributionSubStation";

    protected $connection = 'zone_connection';

    public $timestamps = false;
}
