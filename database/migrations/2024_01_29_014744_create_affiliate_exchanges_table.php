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
        Schema::create('affiliate_exchanges', function (Blueprint $table) {
            $table->id();
            $table->integer("currency")->index();
            $table->float("amount", 15, 8)->default(0);
            $table->float("amount_earned", 15, 8)->default(0);
            $table->integer("exchange_id")->index();
            $table->integer("user_id")->index();
            $table->string("user_credential");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_exchanges');
    }
};
