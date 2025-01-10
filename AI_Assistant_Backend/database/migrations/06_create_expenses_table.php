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
        Schema::create('fp.expenses', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('amount');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('recurring');

            $table->uuid('expense_type_id');
            $table->foreign('expense_type_id')
            ->references('id')
            ->on('fp.expense_types')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->uuid('balance_id');
            $table->foreign('balance_id')
            ->references('id')
            ->on('fp.balances')
            ->onDelete('no action')
            ->onUpdate('no action');

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
