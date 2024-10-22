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
        // Cek jika kolom seller_id belum ada
        if (!Schema::hasColumn('products', 'seller_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('seller_id')->after('id');

                // Jika seller terkait dengan user, tambahkan foreign key
                $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Cek jika kolom seller_id ada sebelum menghapus foreign key dan kolom
            if (Schema::hasColumn('products', 'seller_id')) {
                $table->dropForeign(['seller_id']);
                $table->dropColumn('seller_id');
            }
        });
    }
};
