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
        2 - wait for withdraw
        3 - success
        11 - api error
        12 - cancel
        13 - deleted
        14 - amount error
    */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string("hash");
            $table->integer("user_id")->default(0);
            $table->integer("direction_id");
            $table->integer("currency_from");
            $table->integer("currency_to");
            $table->integer("merchant_from");
            $table->integer("merchant_to");
            $table->string("merchant_type_from");
            $table->string("merchant_type_to");
            $table->tinyInteger("status")->default(0);
            $table->json("data");
            $table->timestamps();

            $table->index(["status", "direction_id", "user_id", "merchant_from", "merchant_to"]);
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
