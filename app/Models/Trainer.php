<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'experience_years',
        'approval'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public static function booted()
    {
        static::addGlobalScope('relation', function (Builder $builder) {
            $builder->with(['service' => function ($query) {
                $query->select('id', 'name');
            }]);
        });
    }

    // Local scope for pending trainers
    public function scopePending(Builder $query): Builder
    {
        return $query->where('approval', 'pending');
    }
}
