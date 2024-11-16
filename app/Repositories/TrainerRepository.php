<?php

namespace App\Repositories;

use App\Models\Trainer;
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

    public function approveTrainer(Trainer $trainer)
    {
        $trainer->update([
            'approval' => 'accepted'
        ]);
    }

    public function rejectTrainer(Trainer $trainer)
    {
        $trainer->update([
            'approval' => 'rejected'
        ]);
    }
}
