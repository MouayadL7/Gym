<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionRepository
{
    public function getAll(): Collection
    {
        return Subscription::select('id', 'name', 'price')->get();
    }

    public function subscribe(array $data): UserSubscription
    {
        return UserSubscription::updateOrCreate($data);
    }

    public function latestSubscription(User $user): UserSubscription
    {
        return $user->subscriptions()->latest('end_date')->first();
    }

    public function updateSubscription(array $data, Subscription $subscription): void
    {
        $subscription->update($data);
    }
}
