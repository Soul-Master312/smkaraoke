<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/6/2019
 * Time: 4:19 PM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\AuthApiRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthApiRepository implements AuthApiRepositoryInterface
{
    public function login($data) : Response
    {
        if ($this->guard()->attempt(['user_name' => $data['user_name'], 'password' => $data['password']])) {

        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('room');
    }
}