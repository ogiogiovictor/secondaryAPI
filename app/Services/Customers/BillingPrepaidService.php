<?php

namespace App\Services\Customers;

use App\Http\Controllers\BaseApiController;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\BillingCustomer;
use Symfony\Component\HttpFoundation\Response;


class BillingPrepaidService extends BaseApiController
{

    private $billingData;

    public function __construct($billingData)
    {
        $this->billingData = $billingData;
    }


    public function getPrepaidCustomers(){

       $prepaidCustomers = BillingCustomer::where("meterNo", $this->billingData->uniqueCode)->first();
    
       return $this->sendSuccess($prepaidCustomers, "Data Successfully Loaded ", Response::HTTP_OK);
    }

}