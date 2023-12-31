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
        Schema::create('catagories', function (Blueprint $table) {
            $table->id();
            $table->string('catagory');
            $table->string('catagory_image');
            $table->string('items_count');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catagories');
    }
};
