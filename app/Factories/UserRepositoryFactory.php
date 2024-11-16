<?php

namespace App\Factories;

use App\Repositories\ClientRepository;
use App\Repositories\TrainerRepository;
use Illuminate\Testing\Exceptions\InvalidArgumentException;

class UserRepositoryFactory
{
    /**
     * Get the appropriate resource collection for the specified type.
     *
     * @param string $type
     * @param \Illuminate\Support\Collection $users
     * @return JsonResource
     */
    public static function make(string $type)
    {
        return match($type) {
            'client' => new ClientRepository,
            'trainer' => new TrainerRepository,
            default => throw new InvalidArgumentException("Invalid user type: $type"),
        };
    }
}
