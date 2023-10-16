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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->boolean("status")->default(true);
            $table->boolean("is_auto")->default(false);
            $table->longText("key")->nullable();
            $table->longText("secret")->nullable();
            $table->longText("token")->nullable();
            $table->timestamps();

            $table->index(["status", "is_auto", "type"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
