<?php

namespace App\DTOs;

class SubscriptionDTO
{
    public function __construct(public int $subscriptionId) {}

    public function toArray(): array
    {
        return [
            'user_id' => auth()->id(),
            'subscription_id' => $this->subscriptionId,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'is_active' => true,
        ];
    }
}
