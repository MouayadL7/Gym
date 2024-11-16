<?php

namespace App\Interfaces;

use App\DTOs\RegisterDTO;

interface UserableDataStrategy
{
    public function getUserableData(RegisterDTO $registerDTO): array;
}
