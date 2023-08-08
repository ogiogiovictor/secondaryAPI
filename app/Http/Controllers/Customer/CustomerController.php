<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\BillingCustomer;
use Symfony\Component\HttpFoundation\Response;



class CustomerController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {

            try {

                $validatedData = $request->validated();

                switch($request->accountType){
                    case 'Prepaid':
                        return new BillingPrepaidService($request);
                    case 'Postpaid':
                        return new BillingPostpaidService($request);
                    default :
                        throw new \InvalidArgumentException('Invalid payment type'); 
                }

              
               // $checkType = BillingCustomer::where("meterNo", $request->uniqueCode)->first();
    
              //  return $this->sendSuccess($checkType, "Data Successfully Loaded ", Response::HTTP_OK);

            }catch(\Exception $e){
                return $this->sendError("Error", $e, Response::HTTP_INTERNAL_SERVER_ERROR);
            }

           
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerRequest $request)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
