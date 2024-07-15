<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MultiTenant
{
    public static function bootMultiTenant()
    {
        if (auth()->check() && auth()->user()->type != 'admin') {
            static::creating(function ($model) {
                $model->tenant_id = auth()->user()->tenant_id;
            });
            static::addGlobalScope('tenant_id', function (Builder $builder) {
                return $builder->where('tenant_id', auth()->user()->tenant_id);
            });
        }
    }
}
