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
        Schema::create('product_packages', function (Blueprint $table) {
            $table->id();
            $table->string('catagory')->default("Narmal");
            $table->string('package_name');
            $table->string('package_discription');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('policy_id')->constrained('policies');
            $table->foreignId('delivery_option_id')->constrained('delivery_options');
            $table->string('package_price');
            $table->string('package_discount_price')->nullable();
            $table->string('rating')->default(0);
            $table->string('ratting_ever')->default(0);
            $table->string('package_quantity')->default(1);
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('product_packages');
    }
};
