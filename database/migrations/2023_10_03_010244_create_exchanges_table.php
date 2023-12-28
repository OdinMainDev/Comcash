<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    /*
        statuses
        0 - created
        1 - paid
        2 - selled currency
        3 - wait for withdraw
        4 - check withdraw
        5 - success
        11 - api error
        12 - cancel
        13 - deleted
        14 - amount error
        15 - withdraw error
    */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string("hash")->index();
            $table->integer("user_id")->default(0)->index();
            $table->integer("direction_id")->index();
            $table->integer("currency_from")->index();
            $table->integer("currency_to")->index();
            $table->integer("merchant_from")->index();
            $table->integer("merchant_to")->index();
            $table->string("merchant_type_from")->index();
            $table->string("merchant_type_to")->index();
            $table->tinyInteger("status")->default(0)->index();
            $table->json("data");
            $table->timestamps();

            $table->index(["status", "hash", "direction_id", "user_id", "merchant_from", "merchant_to"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
