<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainWarehouseCustomer extends Model
{
    use HasFactory;

    protected $connection = 'main_warehouse';

    protected $primaryKey = 'CustomerSK';

    protected $table = "MAIN_WAREHOUSE.dbo.Dimension_customers";

    public $timestamps = false;
}
