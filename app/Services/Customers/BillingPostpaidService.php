<?php

namespace App\Services\Customers;
use Illuminate\Support\Facades\DB;
use App\Models\Customer\ZoneCustomer;
use App\Models\Customer\MainWarehouseCustomer;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseApiController;



class BillingPostpaidService extends BaseApiController
{


    public function getPostpaidCustomers($request){

        $postpaidCustomers = $this->getPostpaidCustomersByZone($request->uniqueCode) 
            ?? $this->getPostpaidCustomersByMainWarehouse($request->uniqueCode, $request->type);

            if (!$postpaidCustomers) {
                return $this->sendError("Error", 'Customer not found', Response::HTTP_NOT_FOUND);
            }

    
        return $this->sendSuccess($postpaidCustomers, "Data Successfully Loaded ", Response::HTTP_OK);
    }

    private function getPostpaidCustomersByZone($uniqueCode)
    {
        return ZoneCustomer::where('accountNo', $uniqueCode)->first();
    }

    private function getPostpaidCustomersByMainWarehouse($uniqueCode, $accountType)
    {
        return MainWarehouseCustomer::where([
            'accountNo' => $uniqueCode,
            'accountType' => $accountType,
        ])->first();
    }


}