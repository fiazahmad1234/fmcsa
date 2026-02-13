<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // link to users
            $table->string('name'); // Account name
            $table->string('email')->unique();
            $table->string('password'); // encrypted password
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->boolean('smtp_encryption')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_configurations');
    }
};
