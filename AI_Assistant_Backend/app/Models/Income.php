<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model ;
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
        'name',
        'description',
        'date',
        'balance_id',
        'amount',
        'recurring',
        'income_type_id',
        'date'
    ];

    public function balance():BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }
}
