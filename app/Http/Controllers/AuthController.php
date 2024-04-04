<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function whoami(Request $request)
    {
        return $this->authService->whoami($request);
    }
    
    public function logout(){
        return $this->authService->logout();
    }
    
    public function login(Request $request) : Response
    {
        return $this->authService->login($request);
    }
}
