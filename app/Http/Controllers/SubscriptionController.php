<?php

namespace App\Http\Controllers;

use App\Exceptions\ActiveSubscriptionException;
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

        return ResponseHelper::sendResponse($subscriptions);
    }

    public function subscribe(SubscribeRequest $request)
    {
        try {
            $response = $this->subscriptionService->subscribeUser($request->toDTO());

            return ResponseHelper::sendResponse($response);

        } catch (ActiveSubscriptionException $ex) {
            return ResponseHelper::sendError($ex->getMessage(), $ex->getCode());
        }
    }

    public function checkUserSubscriptionStatus(User $user)
    {
        $status = $this->subscriptionService->checkUserSubscriptionStatus($user);

        return ResponseHelper::sendResponse(['status' => $status]);
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $this->subscriptionService->updateSubscription($request->toDTO(), $subscription);

        return ResponseHelper::sendResponse($subscription);
    }
}
