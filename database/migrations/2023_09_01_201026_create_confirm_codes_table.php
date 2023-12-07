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
        Schema::create('confirm_codes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->index();
            $table->integer("code")->index();
            $table->string("hash")->index();
            $table->integer("user_id");
            $table->integer("created_at");
            

            $table->index(['type', 'hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirm_codes');
    }
};
