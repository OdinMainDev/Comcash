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
        Schema::create('merchant_logs', function (Blueprint $table) {
            $table->id();
            $table->integer("merchant_id")->index();
            $table->integer("exchange_id")->index();
            $table->string("action")->index();
            $table->longText("url");
            $table->longText("request")->nullable();
            $table->longText("response")->nullable();
            $table->timestamps();

            $table->index(["merchant_id", "action", "exchange_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_logs');
    }
};
