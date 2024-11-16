<?php

namespace App\Services;

use App\DTOs\SubscriptionDTO;
use App\DTOs\UpdateSubscriptionDTO;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\SubscriptionRepository;

class SubscriptionService
{
    public function __construct(protected SubscriptionRepository $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function subscribeUser(SubscriptionDTO $dto)
    {
        return $this->repository->subscribe($dto->toArray());
    }

    public function checkUserSubscriptionStatus(User $user): string
    {
        // Get the user's latest subscription, if it exists
        $latestSubscription = $this->repository->latestSubscription($user);

        if (is_null($latestSubscription)) {
            return 'none';
        }

        // Check if the subscription is active
        if ($latestSubscription->status === 'active' && $latestSubscription->end_date > now()) {
            return 'active';
        }

        // Check if the subscription is expired
        if ($latestSubscription->end_date <= now()) {
            return 'expired';
        }
    }

    /**
     * Get a user-friendly message for each subscription status.
     *
     * @param string $status
     * @return string
     */
    public function getStatusMessage(string $status): string
    {
        return match ($status) {
            'none' => 'You do not have an active subscription.',
            'active' => 'Your subscription is active.',
            'expired' => 'Your subscription has expired. Please renew.',
            default => 'Unknown subscription status.',
        };
    }

    public function updateSubscription(UpdateSubscriptionDTO $dto, Subscription $subscription)
    {
        return $this->repository->updateSubscription($dto->toArray(), $subscription);
    }
}
