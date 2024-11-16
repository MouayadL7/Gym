<?php

namespace App\DTOs;

class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
