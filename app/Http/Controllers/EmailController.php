<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::get();

        return view("email.index", ["emails" => $emails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($template)
    {
        $email = Email::where('template', $template)->first();

        return view('email.edit', ['email' => $email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'subject' => [
                    'required',
                    'max:100',
                ],
                'body' => [
                    'required',
                ],
            ],
        )->validate();


        $email->subject = $request->subject;
        $email->body = $request->body;
        $email->save();

        return redirect('/admin/email')->with('message', 'E-mailová šablona byla úspěšně editována.');
    }
}
