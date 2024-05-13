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
        Schema::create('shared_passwords', function (Blueprint $table) {
            $table->id();
            $table->boolean('valid');
            $table->foreignId('id_owner');
            $table->foreignId('id_receiver');
            $table->foreignId('id_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_passwords');
    }
};
