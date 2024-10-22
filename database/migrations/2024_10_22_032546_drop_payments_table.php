<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('payments');
    }
    
    public function down()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
    
};
