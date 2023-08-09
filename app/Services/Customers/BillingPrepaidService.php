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

        try{

            $prepaidCustomers = BillingCustomer::where("meterNo", $this->billingData['uniqueCode'])->first();

            if(!$prepaidCustomers){
                return $this->sendError("Error", "No Record Found", Response::HTTP_NOT_FOUND);
            }
    
         return $this->sendSuccess($prepaidCustomers, "Data Successfully Loaded ", Response::HTTP_OK);

        }catch(\Exception $e){
            return $this->sendError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

       
    }

}