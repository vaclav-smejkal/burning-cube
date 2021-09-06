<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ], [
            "email.unique" => "Tento :attribute už někdo používá.",
            "email.email" => "Zadaný :attribute není platný.",
            "password.confirmed" => "Hesla se neshodují.",
        ])->validate();

        return User::create([
            'uuid' => Str::uuid(),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'verify_token' => substr(Str::uuid(), 0, 8),
        ]);
    }
}
