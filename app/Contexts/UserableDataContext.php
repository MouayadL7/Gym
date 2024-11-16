<?php

namespace App\Contexts;

use App\DTOs\RegisterDTO;
use App\Interfaces\UserableDataStrategy;
use App\Strategies\UserableDataStrategies\ClientDataStrategy;
use App\Strategies\UserableDataStrategies\TrainerDataStrategy;

class UserableDataContext
{
    protected $strategy;

    public function __construct(RegisterDTO $registerDTO)
    {
        // Choose strategy based on user role
        $this->strategy = $this->getStrategy($registerDTO->role);
    }

    protected function getStrategy(string $role): UserableDataStrategy
    {
        switch ($role) {
            case 'trainer':
                return new TrainerDataStrategy();
            case 'client':
                return new ClientDataStrategy();
            default:
                throw new \Exception('Unknown role');
        }
    }

    public function getUserableData(RegisterDTO $registerDTO): array
    {
        return $this->strategy->getUserableData($registerDTO);
    }
}
