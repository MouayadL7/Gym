<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{
    public function getUsers(): Collection
    {
        return Client::with('user')->get();
    }
}
