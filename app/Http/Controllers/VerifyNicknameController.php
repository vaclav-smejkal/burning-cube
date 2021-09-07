<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VerifyNicknameController extends Controller
{
    public function __construct()
    {
        $this->user = User::class;
    }

    public function index()
    {
        $verifyToken = Auth::user()->verify_token;

        return view("verify-nickname", ["verifyToken" => $verifyToken]);
    }

    public function update(Request $request, $uuid)
    {
        $user = $this->user::where('uuid', $uuid)->first();

        $validator = Validator::make(
            $request->all(),
            $rules = [
                'nickname' => [
                    'required',
                    'max:100',
                ],
            ],
        )->validate();
        $foundUser = $this->user::where('nickname', $user->nickname)->first();

        if ($request->nickname != $foundUser->nickname && $foundUser) {
            throw ValidationException::withMessages(['nickname' => 'Tento nickname již existuje.']);
        } else {
            $user->nickname = $request->nickname;
            $user->verified = 1;
            $user->save();
        }

        return redirect('/');
    }
}
