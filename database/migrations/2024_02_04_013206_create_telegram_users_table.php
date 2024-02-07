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
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->string("username")->index()->nullable();
            $table->integer("user_id")->index();
            $table->bigInteger("telegram_id")->index();
            $table->bigInteger("bot_id")->index();
            $table->string("action")->default(0);
            $table->text("action_dafa")->nullable();
            $table->boolean("is_member")->index()->default(true);
            $table->string("language");
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->boolean("is_premium")->default(false);
            $table->boolean("is_rules_accepted")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_users');
    }
};
