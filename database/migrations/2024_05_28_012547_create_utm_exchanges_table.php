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
        Schema::create('utm_exchanges', function (Blueprint $table) {
            $table->id();
            $table->string("direction")->index();
            $table->integer("exchange_id")->index();
            $table->integer("utm_id")->index();
            $table->boolean("is_completed")->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utm_exchanges');
    }
};
