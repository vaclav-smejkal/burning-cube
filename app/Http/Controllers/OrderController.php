<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $order;
    public function __construct()
    {
        $this->order = Order::class;
    }

    public function show($sanitized_name)
    {
        $package = Package::where('sanitized_name', $sanitized_name)->first();

        return view('order.show', ['package' => $package]);
    }
    public function store(Request $request)
    {
        if (!Auth::user()) {
            $rules = [
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => [
                    'required',
                    'string',
                    new Password,
                    'confirmed'
                ],
                'nickname' => [
                    'required',
                    'max:100',
                    'unique:users'
                ],
                'name_surname' => [
                    'max:100',
                    'required',
                ],
                'place' => [
                    'required',
                ],
                'psc' => [
                    'required',
                    'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                ],
                'terms' => [
                    'required',
                ],
            ];
            $messages = [
                "email.unique" => "Tento :attribute už někdo používá.",
                "email.email" => "Zadaný :attribute není platný.",
                "password.confirmed" => "Hesla se neshodují.",
                "psc.regex" => "Zadejte správný formát PSČ",
                "terms.required" => "Musíte souhlasit s všeobecnými obchodními podmínkami.",
            ];

            $validator = Validator::make(
                $request->all(),
                $rules,
                $messages,
            )->validate();

            $user = User::create([
                'uuid' => Str::uuid(),
                'email' => $request->email,
                'nickname' => $request->nickname,
                'password' => Hash::make($request->password),
                'verify_token' => substr(Str::uuid(), 0, 8),
            ]);

            Auth::login($user);
        } else {
            if (!Auth::user()->nickname) {
                $rules = [
                    'nickname' => [
                        'max:100',
                        'required',
                        'unique:users',
                    ],
                    'name_surname' => [
                        'max:100',
                        'required',
                    ],
                    'place' => [
                        'required',
                    ],
                    'psc' => [
                        'required',
                        'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                    ],
                    'terms' => [
                        'required',
                    ],
                ];
                $messages = [
                    "psc.regex" => "Zadejte správný formát PSČ",
                    "terms.required" => "Musíte souhlasit s všeobecnými obchodními podmínkami.",
                ];

                $validator = Validator::make(
                    $request->all(),
                    $rules,
                    $messages,
                )->validate();

                $user = Auth::user();
                $user->nickname = $request->nickname;
                $user->save();
            } else {
                $rules = [
                    'name_surname' => [
                        'max:100',
                        'required',
                    ],
                    'place' => [
                        'required',
                    ],
                    'psc' => [
                        'required',
                        'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                    ],
                    'terms' => [
                        'required',
                    ],
                ];
                $messages = [
                    "psc.regex" => "Zadejte správný formát PSČ",
                    "terms.required" => "Musíte souhlasit s všeobecnými obchodními podmínkami.",
                ];

                $validator = Validator::make(
                    $request->all(),
                    $rules,
                    $messages,
                )->validate();

                $request->nickname = Auth::user()->nickname;
            }
            $request->email = Auth::user()->email;
        }

        $this->order::create([
            'email' => $request->email,
            'nickname' => $request->nickname,
            'comment' => $request->comment,
            'name_surname' => $request->name_surname,
            'place' => $request->place,
            'psc' => $request->psc,
            'uuid' => Str::uuid(),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('message', 'Byla vytvořena objednávka.');
    }
}
