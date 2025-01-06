<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeTypeFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.income_types';
    public $timestamps = true;

    protected $fillable = [
        'name' => 'string',
        'active' => 'boolean'
    ];
}
