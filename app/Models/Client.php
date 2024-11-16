<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'age',
        'height',
        'weight'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
