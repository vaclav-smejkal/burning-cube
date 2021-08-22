<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyNickController extends Controller
{
    public function index()
    {
        $randomString = Auth::user()->random_string;

        return view("verify-nick", ["randomString" => $randomString]);
    }
}
