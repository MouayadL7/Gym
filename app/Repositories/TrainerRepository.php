<?php

namespace App\Repositories;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TrainerRepository
{
    public function getUsers(): Collection
    {
        return Trainer::with('user')->get();
    }

    public function getTrainersByService(int $service_id): Collection
    {
        return Trainer::where('service_id', $service_id)
                    ->with('user')
                    ->get();
    }
}
