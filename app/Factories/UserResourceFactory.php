<?php

namespace App\Factories;

use App\Http\Resources\ClientResource;
use App\Http\Resources\TrainerResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

class UserResourceFactory
{
    /**
     * Get the appropriate resource or resource collection for the specified type.
     *
     * @param string $type
     * @param mixed $users A single user instance or a collection of users.
     * @return JsonResource
     */
    public static function make(string $type, $users): JsonResource
    {
        return match($type) {
            'client' => ClientResource::collection($users),
            'trainer' => TrainerResource::collection($users),
            default => throw new InvalidArgumentException('Invalid user type specified.')
        };
    }
}
