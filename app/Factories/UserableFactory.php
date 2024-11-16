<?php

namespace App\Factories;

use App\Models\Client;
use App\Models\Trainer;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidUserRoleException;

class UserableFactory
{
    protected static array $map = [
        'client' => Client::class,
        'trainer' => Trainer::class,
    ];

    public static function create(string $role, array $data): Model
    {
        if (!array_key_exists($role, self::$map)) {
            throw new InvalidUserRoleException();
        }

        $modelClass = self::$map[$role];
        return $modelClass::create($data);
    }
}

