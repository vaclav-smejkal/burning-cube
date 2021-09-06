<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VerifyNickController extends Controller
{
    public function __construct()
    {
        $this->user = User::class;
    }

    public function index()
    {
        $verifyToken = Auth::user()->verify_token;

        return view("verify-nick", ["verifyToken" => $verifyToken]);
    }

    public function update(Request $request, $uuid)
    {
        $user = $this->user::where('uuid', $uuid)->first();

        $validator = Validator::make(
            $request->all(),
            $rules = [
                'nick' => [
                    'required',
                    'max:100',
                ],
            ],
        )->validate();
        $foundUser = $this->user::where('nick', $user->nick)->first();

        if ($request->nick != $foundUser->nick && $foundUser) {
            throw ValidationException::withMessages(['nick' => 'Nick již existuje.']);
        } else {
            $user->nick = $request->nick;
            $user->verified = 1;
            $user->save();
        }

        return redirect('/');
    }
}
