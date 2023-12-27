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
        Schema::create('shop_deteils', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained('users');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->string('shop_address');
            $table->string('tin_number');
            $table->string('bin_number');
            $table->string('owner_name');
            $table->string('owner_nid');
            $table->string('owner_phone');
            $table->string('email');
            $table->string('phone_verify');
            $table->string('email_verify');
            $table->string('tow_factor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_deteils');
    }
};
