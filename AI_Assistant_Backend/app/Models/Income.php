<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory, Uuid;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'fp.income';
    public $timestamps = true;

    protected $fillable = [
        'balance_id' => 'uuid',
        'amount' => 'string',
        'recurring' => 'boolean',
        'income_type' => 'id',
        'amount' => 'string'
    ];

    public function balance():BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
