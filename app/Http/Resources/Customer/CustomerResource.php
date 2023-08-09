<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Payment\ECMIPayment;
use App\Models\Payment\EMSPayment;
use App\Models\Customer\BusinessUnit;
use App\Models\Customer\Tariff;
use App\Models\Customer\FeederPillars;
use App\Models\Customer\DistributionSubStation;
use App\Models\Customer\TarrifRate;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 
            'customerName' => $this->Surname . ' '. $this->FirstName,
            'address' => $this->Address1. ' '. $this->Address2,
            'meterNumber' => $this->MeterNo,
            'accountNumber' => $this->AccountNo,
            'businessUnit' => BusinessUnit::where("BUID", $this->BUID)->value("Name"),
            'undertaking' => $this->UTID. " Undertaking",
            "phoneNumber" => $this->Mobile,
            "email" =>  $this->Email,
            "businessUnitId" =>  $this->BUID,
             "minimumPurchase" => 0, // EMSPayment::where("AccountNo", $this->AccountNo)->min('Payments'),
            "tariffcode" =>  Tariff::where("TariffID", $this->TariffID)->value("NewTariffCode"),
            "customerArrears" =>  (int)$this->ArrearsBalance,
            "tariff" => TarrifRate::where("TariffID", Tariff::where("TariffID", $this->TariffID)->value("TariffID"))->value("Rate"), 
            "tariff2" => TarrifRate::where("TariffID", $this->TariffID)->where("Status", "FROZEN")->value("Rate"),
            "serviceBand" => TarrifRate::where("TariffID", $this->TariffID)->value("ServiceID"), 
            "feederName" => FeederPillars::where("FeederID", DistributionSubStation::where("DistributionID", $this->DistributionStation)->value("FeederID"),)->value("Description"),
            "dssName" => DistributionSubStation::where("DistributionID", $this->DistributionStation)->value("Name"),
            "TIN" => "17780815-0001",
            "bandAdjustment" => 0,
            "tariffID" => $this->TariffID,
            "oldTi" => 0

            //"lastTransactionDate" =>  EMSPayment::select('Payments')->latest('PayDate')->where("AccountNo", $this->AccountNo)->value('PayDate'),
           // "lastTransactionDate" => EMSPayment::where("AccountNo", $this->AccountNo)->max('PayDate'),
            
            
          
        ];
        //return parent::toArray($request);
    }
}


