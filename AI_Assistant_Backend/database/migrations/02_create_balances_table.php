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
        Schema::create('fp.balances', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();

            $table->uuid('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade');
            
            $table->uuid('income_id');
            $table->foreign('income_id')
            ->references('id')
            ->on('fp.incomes')
            ->onUpdate('cascade');

            $table->uuid('expense_id');
            $table->foreign('expense_id')
            ->references('id')
            ->on('fp.expenses')
            ->onUpdate('cascade');
            
            $table->string('balance');
            $table->string('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
