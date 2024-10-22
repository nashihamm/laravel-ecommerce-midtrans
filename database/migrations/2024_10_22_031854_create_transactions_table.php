<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
        {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('order_id');
                $table->string('transaction_id')->nullable();
                $table->string('payment_type')->nullable();
                $table->string('transaction_status')->default('pending');
                $table->decimal('gross_amount', 12, 2);
                $table->string('fraud_status')->nullable();
                $table->timestamp('transaction_time')->nullable();

                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            });
        }

};
