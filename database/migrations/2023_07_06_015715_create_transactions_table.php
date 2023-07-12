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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('accounts_number', 16);
            $table->string('type', 20);
            $table->bigInteger('amount');
            $table->string('status', 30);
            $table->string('recipient', 16)->nullable();
            $table->timestamp('timestamp');
            $table->timestamps();

            $table->foreign('accounts_number')->references('number')->on('accounts');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
