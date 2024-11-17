<?php

namespace App\Services;

use App\DTOs\SubscriptionDTO;
use App\DTOs\UpdateSubscriptionDTO;
use App\Exceptions\ActiveSubscriptionException;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    public function __construct(protected SubscriptionRepository $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function subscribeUser(SubscriptionDTO $dto)
    {
        if (Auth::user()->hasActiveSubscription()) {
            throw new ActiveSubscriptionException();
        }

        return $this->repository->subscribe($dto->toArray());
    }

    public function checkUserSubscriptionStatus(User $user): string
    {
        // Get the user's latest subscription, if it exists
        $latestSubscription = $this->repository->latestSubscription($user);

        if (is_null($latestSubscription)) {
            return 'none';
        }

        // Check if the subscription is expired
        if ($latestSubscription->end_date <= now()) {
            return 'expired';
        }

        return 'active';
    }

    public function updateSubscription(UpdateSubscriptionDTO $dto, Subscription $subscription)
    {
        $this->repository->updateSubscription($dto->toArray(), $subscription);
    }
}
