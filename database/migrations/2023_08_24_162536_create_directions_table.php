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
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("currency_from");
            $table->string("currency_to");
            $table->integer("merchant_from");
            $table->integer("merchant_to");
            $table->integer("position");
            $table->boolean("status")->default(true);
            $table->bigInteger("total_in")->default(0);
            $table->bigInteger("total_out")->default(0);
            $table->float("profit_percent", 3, 2)->default(1);
            $table->json("data");
            $table->timestamps();

            $table->index(["position", "merchant_from", "merchant_to", "currency_from", "currency_to"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directions');
    }
};
