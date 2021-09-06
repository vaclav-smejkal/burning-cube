<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AddNickController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = User::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-nick');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $user = $this->user::where('uuid', $uuid)->first();

        $validator = Validator::make(
            $request->all(),
            $rules = [
                'nick' => [
                    'required',
                    'max:100',
                    'unique:users'
                ],
            ],
        )->validate();

        $user->nick = $request->nick;
        $user->save();

        return redirect('/');
    }
}
