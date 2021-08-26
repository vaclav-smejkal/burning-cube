<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyNickController extends Controller
{
    public function index()
    {
        $verifyToken = Auth::user()->verify_token;

        return view("verify-nick", ["verifyToken" => $verifyToken]);
    }
}
