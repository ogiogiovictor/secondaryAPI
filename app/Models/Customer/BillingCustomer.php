<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingCustomer extends Model
{
    use HasFactory;

    protected $table = "ECMI.dbo.Customers";

    protected $connection = 'ecmi_prod';

    public $timestamps = false;
}
