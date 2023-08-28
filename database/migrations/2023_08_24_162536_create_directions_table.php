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
            $table->boolean("status")->default(true);
            $table->timestamps();

            $table->index(["merchant_from", "merchant_to", "currency_from", "currency_to"]);
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
