<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AuthService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function whoami(Request $request){
        return $this->userRepository->whoami($request);
    }
    
    public function logout(){
        return $this->userRepository->logout();
    }
    
    public function login(Request $request) : Response
    {
        return $this->userRepository->login($request);
    }
}