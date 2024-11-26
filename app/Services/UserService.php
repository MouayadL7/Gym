<?php

namespace App\Services;

use App\Factories\UserRepositoryFactory;
use App\Factories\UserResourceFactory;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $repository;
    public function __construct(protected string $type = 'trainer') {
        $this->repository = UserRepositoryFactory::make($type);
    }

    public function getUsers(string $type)
    {
        $users = $this->repository->getUsers($type);

        return UserResourceFactory::make($type, $users);
    }

    public function getTrainersByService(int $service_id)
    {
        $trainers = $this->repository->getTrainersByService($service_id);

        return TrainerResource::collection($trainers);
    }
}
