<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseTypeFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.expense_types';
    public $timestamps = true;

    protected $fillable = [
        'name' => 'string',
        'active' => 'boolean'
    ];
}
