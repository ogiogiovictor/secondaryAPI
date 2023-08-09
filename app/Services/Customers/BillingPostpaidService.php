<?php

namespace App\Services\Customers;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\ZoneCustomer;
use App\Models\Customer\MainWarehouseCustomer;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseApiController;
use App\Http\Resources\Customer\CustomerResource;



class BillingPostpaidService extends BaseApiController
{


    public function getPostpaidCustomers($request){

       
        try {

            $postpaidCustomers = $this->getPostpaidCustomersByZone($request['uniqueCode']) 
            ?? $this->getPostpaidCustomersByMainWarehouse($request['uniqueCode'], $request['accountType']);

            if (!$postpaidCustomers) {
                return $this->sendError("Error", 'Customer not found', Response::HTTP_NOT_FOUND);
            }

    
        return $this->sendSuccess(new CustomerResource($postpaidCustomers), "Data Successfully Loaded ", Response::HTTP_OK);


        }catch(\Exception $e){

            return $this->sendError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getPostpaidCustomersByZone($uniqueCode)
    {
        return ZoneCustomer::where('AccountNo', $uniqueCode)->first();
    }

    private function getPostpaidCustomersByMainWarehouse($uniqueCode, $accountType)
    {
        return MainWarehouseCustomer::where([
            'AccountNo' => $uniqueCode,
            'accountType' => $accountType,
        ])->first();
    }


}