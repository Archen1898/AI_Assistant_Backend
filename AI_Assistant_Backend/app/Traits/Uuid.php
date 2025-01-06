<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    public static function boot():void
    {
        parent::boot();
        
        static::creating(function ($model) {
            if(!$model->getKey())
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
