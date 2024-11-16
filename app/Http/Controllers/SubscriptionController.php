<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(protected SubscriptionService $subscriptionService) {}

    public function index()
    {
        $subscriptions = $this->subscriptionService->getAll();

        return ResponseHelper::sendResponse($subscriptions, 'Subscriptions retrieved successfully');
    }

    public function subscribe(SubscribeRequest $request)
    {
        $response = $this->subscriptionService->subscribeUser($request->toDTO());

        return ResponseHelper::sendResponse($response, 'Subscription successfully created.');
    }

    public function checkUserSubscriptionStatus(User $user)
    {
        $status = $this->subscriptionService->checkUserSubscriptionStatus($user);
        $message = $this->subscriptionService->getStatusMessage($status);

        return ResponseHelper::sendResponse(['status' => $status], $message);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription = $this->subscriptionService->updateSubscription($request->toDTO(), $subscription);

        return ResponseHelper::sendResponse($subscription, 'Subscription updated successfully.');
    }
}
