<?php

namespace App\Strategies\UserableDataStrategies;

use App\DTOs\RegisterDTO;
use App\Interfaces\UserableDataStrategy;

class TrainerDataStrategy implements UserableDataStrategy
{
    public function getUserableData(RegisterDTO $registerDTO): array
    {
        // Trainer-specific logic for data
        return [
            'experience_years' => $registerDTO->experience_years,
            'service_id' => $registerDTO->service_id,
            'cv' => $registerDTO->cv
        ];
    }
}
