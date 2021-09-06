<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = User::class;
    }

    public function index()
    {
        $users = $this->user::get();

        return view("user.index", ["users" => $users]);
    }

    public function edit($uuid)
    {
        $user = $this->user::where('uuid', $uuid)->first();

        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'nickname' => [
                    'required',
                    'max:100',
                ],
                'email' => [
                    'required',
                    'email'
                ],
            ],
            $messages = []
        )->validate();

        $foundNickname = $this->user::where('nickname', $request->nickname)->first();

        if ($foundNickname && $foundNickname->nickname != $user->nickname) {
            throw ValidationException::withMessages(['nickname' => 'Tento nickname již existuje.']);
        } else {
            $user->nickname = $request->nickname;
            $user->email = $request->email;

            $user->save();

            return redirect('/admin/user')->with('message', 'Uživatel byl editován.');
        }
    }

    public function destroy($uuid)
    {
        $user = $this->user::where('uuid', $uuid)->first();
        $user->delete();

        return redirect("/admin/user")->with('message', 'Uživatel byl smazán.');
    }
}
