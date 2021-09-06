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
                'nick' => [
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

        $foundNick = $this->user::where('nick', $request->nick)->first();

        if ($foundNick && $foundNick->nick != $user->nick) {
            throw ValidationException::withMessages(['nick' => 'Tento nick již existuje.']);
        } else {
            $user->nick = $request->nick;
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
