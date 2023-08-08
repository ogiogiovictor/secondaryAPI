<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Customer\CustomerRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Customers\BillingPrepaidService;
use App\Services\Customers\BillingPostpaidService;



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
                        return (new BillingPrepaidService($validatedData))->getPrepaidCustomers();
                    case 'Postpaid':
                        return (new BillingPostpaidService)->getPostpaidCustomers($validatedData);
                    default :
                        throw new \InvalidArgumentException('Invalid payment type'); 
                }

            }catch(\Exception $e){
                return $this->sendError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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
