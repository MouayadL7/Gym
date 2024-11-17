<?php

namespace App\Repositories;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TrainerRepository
{
    public function getUsers(): Collection
    {
        return Trainer::where('approval', 'accepted')
                    ->with('user')
                    ->get();
    }

    public function getTrainersByService(int $service_id): Collection
    {
        return Trainer::where('service_id', $service_id)
                    ->where('approval', 'accepted')
                    ->with('user')
                    ->get();
    }

    public function getPendingTrainers(): Collection
    {
        return Trainer::pending()
                    ->with('user')
                    ->get();
    }

    public function approveTrainer(User $user)
    {
        $user->userable->update([
            'approval' => 'accepted'
        ]);
    }

    public function rejectTrainer(User $user)
    {
        $user->userable->update([
            'approval' => 'rejected'
        ]);
    }
}
