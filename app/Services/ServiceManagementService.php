<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Database\Eloquent\Collection;

class ServiceManagementService
{
    public function __construct(protected ServiceRepository $repository) {}

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function get(Service $service)
    {
        return $this->repository->get($service);
    }
}
