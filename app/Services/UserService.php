<?php

namespace App\Services;

use App\Factories\UserRepositoryFactory;
use App\Factories\UserResourceFactory;
use App\Http\Resources\TrainerResource;
use App\Models\Trainer;
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

    public function getPendingTrainers()
    {
        $pendingTrainers = $this->repository->getPendingTrainers();

        return TrainerResource::collection($pendingTrainers)->each->withCv();
    }

    public function approveTrainer(Trainer $trainer)
    {
        $this->repository->approveTrainer($trainer);

        return new TrainerResource($trainer);
    }

    public function rejectTrainer(Trainer $trainer)
    {
        $this->repository->rejectTrainer($trainer);

        return new TrainerResource($trainer);
    }
}
