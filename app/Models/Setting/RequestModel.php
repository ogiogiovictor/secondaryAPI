<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = "serverrequest";

    protected $fillable = [
        'route',
        'payload',
        'link',
    ];

}
