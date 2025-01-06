<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    /** @use HasFactory<\Database\Factories\ExpensesFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.expenses';
    public $timestamps = true;

    protected $fillable = [
        'balance_id' => 'uuid',
        'amount' => 'string',
        'recurring' => 'boolean',
        'expense_type' => 'id',
        'amount' => 'string'
    ];
}
