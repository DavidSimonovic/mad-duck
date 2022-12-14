<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Repositories\imp\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(protected UserRepository $userRepository)
    {

    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->returnResponseSuccess(null, __('Logged out'), Response::HTTP_OK);
    }

    /**
     * @param Login $request
     * @return JsonResponse
     */
    protected function login(Login $request): JsonResponse
    {

        $user = $this->userRepository->userByEmail($request->email);

        if ($user->blocked) {
            return $this->returnResponseError(null, __('User is blocked'), Response::HTTP_UNAUTHORIZED);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnResponseError(null, __('Bad credentials'), Response::HTTP_UNAUTHORIZED);
        }

        return $this->returnResponseSuccess(
            ['token' => $user->createToken(config('auth.token_prefix'))->plainTextToken],
            __('You have successfully logged in'),
            200
        );
    }

    /**
     * @param Register $request
     * @return JsonResponse
     */
    protected function register(Register $request): JsonResponse
    {
        $user = $this->userRepository->registration($request);

        return $this->returnResponseSuccess(
            ['token' => $user->createToken(config('auth.token_prefix'))->plainTextToken],
            __('You have successfully signed up'),
            Response::HTTP_CREATED
        );
    }
}
