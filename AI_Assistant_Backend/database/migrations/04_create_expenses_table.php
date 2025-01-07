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
        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('amount');
            $table->boolean('recurring');

            $table->uuid('expense_type_id');
            $table->foreign('expense_type_id')
            ->references('id')
            ->on('fp.income_types')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->uuid('balance_id');
            $table->foreign('balance_id')
            ->references('id')
            ->on('fp.balances')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->date('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
