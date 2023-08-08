<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPAddressModel extends Model
{
    use HasFactory;

    protected $table = "ipaddress";

    protected $fillable = [
        'domain_name',
        'ip_address',
        'appSecret',
        'appToken',
        'status'
    ];
}
