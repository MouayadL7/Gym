<?php

namespace App\Strategies\UserableDataStrategies;

use App\DTOs\RegisterDTO;
use App\Interfaces\UserableDataStrategy;

class ClientDataStrategy implements UserableDataStrategy
{
    public function getUserableData(RegisterDTO $registerDTO): array
    {
        // Client-specific logic for data
        return [
            'age' => $registerDTO->age,
        ];
    }
}
