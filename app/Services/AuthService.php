<?php

namespace App\Services;

use App\Contexts\UserableDataContext;
use App\DTOs\LoginDTO;
use App\DTOs\RegisterDTO;
use App\Factories\UserableFactory;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function registerUser(RegisterDTO $dto): User
    {
        $userableDataContext = new UserableDataContext($dto);
        $userableData = $userableDataContext->getUserableData($dto);

        $userable = UserableFactory::create($dto->role, $userableData);

        $user = $this->userRepository->create($dto->toArray());

        $user->userable()->associate($userable);
        $user->save();

        return $user;
    }

    public function loginUser(LoginDTO $dto): array
    {
        try {
            if (!Auth::attempt($dto->toArray())) {
                throw new AuthenticationException('Invalid credentials.');
            }

            $user = Auth::user();

            /** @var App\Models\User $user */
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token
            ];

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function logoutUser(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
