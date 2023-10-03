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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string("hash");
            $table->integer("direction_id");
            $table->integer("currency_from");
            $table->integer("currency_to");
            $table->integer("merchant_from");
            $table->integer("merchant_to");
            $table->string("merchant_type_from");
            $table->string("merchant_type_to");
            $table->integer("status")->default(0);
            $table->json("data");
            $table->timestamps();

            $table->index(["status", "direction_id"]);
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
