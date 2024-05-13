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
            $table->boolval('valid');
            $table->foreign('id_owner')->references('id')->on('users');
            $table->foreign('id_receiver')->references('id')->on('users');
            $table->foreing('id_password')->references('id')->on('passwords');
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
