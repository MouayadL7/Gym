<?php

namespace App\DTOs;

class UpdateSubscriptionDTO
{
    public function __construct(
        public string $price,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'price' => $this->price,
        ], fn($value) => !is_null($value));
    }
}
