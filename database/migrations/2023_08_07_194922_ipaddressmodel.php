<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ipaddress', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->default(0);
            $table->string('ip_address')->default(0);
            $table->string('appSecret')->default(0);
            $table->string('appToken')->default(0);
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipaddress');
    }
};
