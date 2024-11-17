<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserTypeRequest;
use App\Models\Trainer;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct() {
        $type = request()->route('type') ? request()->route('type') : 'trainer';
        $this->userService = new UserService($type);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserTypeRequest $request)
    {
        $type = $request->route('type');
        $users = $this->userService->getUsers($type);

        return ResponseHelper::sendResponse($users);
    }

    public function getTrainersByService(int $service_id)
    {
        $trainers = $this->userService->getTrainersByService($service_id);

        return ResponseHelper::sendResponse($trainers);
    }

    public function getPendingTrainers()
    {
        $pendingTrainers = $this->userService->getPendingTrainers();

        return ResponseHelper::sendResponse($pendingTrainers);
    }

    public function approveTrainer(User $user)
    {
        $approvedTrainer = $this->userService->approveTrainer($user);

        return ResponseHelper::sendResponse($approvedTrainer);
    }

    public function rejectTrainer(User $user)
    {
        $rejectedTrainer = $this->userService->rejectTrainer($user);

        return ResponseHelper::sendResponse($rejectedTrainer);
    }
}
