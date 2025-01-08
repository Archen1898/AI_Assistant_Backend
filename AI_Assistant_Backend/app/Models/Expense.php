<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpensesFactory> */
    use HasFactory, Uuid;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.expenses';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'balance_id',
        'amount',
        'recurring',
        'expense_type_id',
        'date'
    ];
}
