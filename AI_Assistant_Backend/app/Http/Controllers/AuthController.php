<?php

namespace App\Http\Controllers;

//Global Import

use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//Local Import
use App\Traits\ResponseTrait;
use App\Repositories\AuthRepository;

class AuthController extends Controller
{
    use ResponseTrait;
    protected AuthRepository $authRepository;

    public function __construct(private AuthRepository $AuthRepository)
    {
        $this->authRepository = $AuthRepository;
    }
    public function login(LoginRequest $loginRequest)//Make LoginRequest
    {
        try {
            return $this->response(Response::HTTP_OK, trans('auth.login'), $this->authRepository->login($loginRequest->all()), null);
        } catch (Exception $exception) {
            return $this->response(Response::HTTP_BAD_REQUEST, $exception->getMessage(), [], $exception->getMessage());
        }
    }
}
