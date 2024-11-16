<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUsers(string $type)
    {
        return User::where('role', $type)
                    ->with('userable')
                   ->get();
    }

    public function getTrainersByService(int $service_id)
    {
        return User::where('role', 'trainer')
                    ->with('userable')
                    ->whereHas('userable', function ($query) use ($service_id) {
                        $query->where('service_id', $service_id)->where('approval', 'accepted');
                    })
                    ->get();
    }

    public function getPendingTrainers()
    {
        // Retrieve trainers with 'approval' status set to 'pending' by bypassing the 'approved' global scope
        return User::where('role', 'trainer')
                    ->with('userable')
                    ->whereHas('userable', function ($query) {
                        $query->where('approval', 'pending');
                    })
                    ->get();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }
}
