<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balance extends Model
{
    /** @use HasFactory<\Database\Factories\BalanceFactory> */
    use HasFactory,Uuid;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.balances';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'year',
        'month',
        'income_id',
        'expense_id',

    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function income():HasMany
    {
        return $this->hasMany(Income::class);
    }
    public function expense():HasMany
    {
        return $this->hasMany(Expenses::class);
    }
}
