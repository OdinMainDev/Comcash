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
        2 - decline
    */
    public function up(): void
    {
        Schema::create('affiliate_withdraws', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->index();
            $table->tinyInteger("status")->index();
            $table->integer("currency")->index();
            $table->float("amount", 15, 8)->default(0);
            $table->text("reason")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_withdraws');
    }
};
