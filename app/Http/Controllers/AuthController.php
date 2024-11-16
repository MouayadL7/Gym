<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->registerUser($request->toDTO());

        return ResponseHelper::sendResponse($response, 'User registered successfully');
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->authService->loginUser($request->toDTO());

            return ResponseHelper::sendResponse($response, 'User Logged in successfully');

        } catch (\Exception $ex) {
            return ResponseHelper::sendError($ex->getMessage(), $ex->getCode());
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logoutUser($request);

        return ResponseHelper::sendResponse([], 'User logged out successfully');
    }
}
