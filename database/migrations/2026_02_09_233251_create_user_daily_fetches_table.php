<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_daily_fetches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('mc_count')->default(0);      // number of MCs fetched today
            $table->integer('email_count')->default(0);   // number of emails fetched today
            $table->date('fetch_date');                   // date of fetch
            $table->timestamps();

            $table->unique(['user_id', 'fetch_date']);    // one row per user per day
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_daily_fetches');
    }
};
