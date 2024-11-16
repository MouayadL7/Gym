<?php

namespace App\Repositories;

use App\Http\Resources\TrainerResource;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    public function getAll(): Collection
    {
        return Service::select('id', 'name')->get();
    }

    public function get(Service $service)
    {
        $service->load(['trainers' => function ($query) {
            $query->where('approval', 'accepted'); // Only fetch approved trainers
        }]);

        return $service;
    }
}
