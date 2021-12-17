<?php

namespace App\Http\Controllers;

use GoPay\Definition\Language;
use GoPay\Definition\Payment\Currency;
use GoPay\Definition\Payment\PaymentInstrument;
use GoPay\Definition\Payment\BankSwiftCode;
use GoPay\Definition\Payment\VatRate;
use GoPay\Definition\Payment\PaymentItemType;
use App\Models\Package;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use GoPay;
use Illuminate\Support\Env;

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
                'nickname' => [
                    'required',
                    'max:100',
                    'unique:users'
                ],
                // 'name_surname' => [
                //     'max:100',
                //     'required',
                // ],
                // 'place' => [
                //     'required',
                // ],
                // 'psc' => [
                //     'required',
                //     'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                // ],
                'terms' => [
                    'required',
                ],
                'package_sanitized_name' => [
                    'required'
                ]
            ];
            $messages = [
                "email.unique" => "Tento :attribute už někdo používá.",
                "email.email" => "Zadaný :attribute není platný.",
                "psc.regex" => "Zadejte správný formát PSČ",
                "terms.required" => "Musíte souhlasit s všeobecnými obchodními podmínkami.",
            ];

            $validator = Validator::make(
                $request->all(),
                $rules,
                $messages,
            )->validate();
        } else {
            if (!Auth::user()->nickname) {
                $rules = [
                    'nickname' => [
                        'max:100',
                        'required',
                        'unique:users',
                    ],
                    // 'name_surname' => [
                    //     'max:100',
                    //     'required',
                    // ],
                    // 'place' => [
                    //     'required',
                    // ],
                    // 'psc' => [
                    //     'required',
                    //     'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                    // ],
                    'terms' => [
                        'required',
                    ],
                    'package_sanitized_name' => [
                        'required'
                    ]
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
                    // 'name_surname' => [
                    //     'max:100',
                    //     'required',
                    // ],
                    // 'place' => [
                    //     'required',
                    // ],
                    // 'psc' => [
                    //     'required',
                    //     'regex:/(^[0-9]{3}(\s)[0-9]{2}|[0-9]{5}$)/'
                    // ],
                    'terms' => [
                        'required',
                    ],
                    'package_sanitized_name' => [
                        'required'
                    ]
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

        $package = Package::where("sanitized_name", $request->package_sanitized_name)->first();

        if (!$package) {
            throw ValidationException::withMessages(['package_sanitized_name' => "Tento balíček neexistuje."]);
        }

        $newOrder = $this->order::create([
            'email' => $request->email,
            'nickname' => $request->nickname,
            'comment' => $request->comment,
            // 'name_surname' => $request->name_surname,
            // 'place' => $request->place,
            // 'psc' => $request->psc,
            'name_surname' => "null",
            'place' => "null",
            'psc' => "null",
            'uuid' => Str::uuid(),
            'package_id' => $package->id
        ]);

        $gopay =  GoPay\payments([
            'goid' => env('GOID'),
            'clientId' => env('CLIENT_ID'),
            'clientSecret' => env('CLIENT_SECRET'),
            'gatewayUrl' => 'https://gw.sandbox.gopay.com/',
            'scope' => GoPay\Definition\TokenScope::ALL,
            'language' => GoPay\Definition\Language::CZECH,
            'timeout' => 30
        ]);

        $response = $gopay->createPayment([
            'payer' => [
                'allowed_payment_instruments' => [PaymentInstrument::PAYMENT_CARD, PaymentInstrument::BANK_ACCOUNT, PaymentInstrument::GPAY, PaymentInstrument::APPLE_PAY, PaymentInstrument::GOPAY, PaymentInstrument::MPAYMENT, PaymentInstrument::PAYSAFECARD, PaymentInstrument::BITCOIN],
                'contact' => [
                    'email' => $request->email,
                ]
            ],
            'amount' => $package->price * 100,
            'currency' => Currency::CZECH_CROWNS,
            'order_number' => $newOrder->uuid,
            'items' => [
                [
                    'type' => 'ITEM',
                    'name' => $package->name,
                    'amount' => $package->price * 100,
                    'count' => 1,
                    'vat_rate' => VatRate::RATE_4
                ],
            ],
            'callback' => [
                'return_url' => 'https://after-life.cz/order/' . $package->sanitized_name,
                'notification_url' => 'https://after-life.cz/thanks'
            ],
            'lang' => Language::CZECH
        ]);

        // return redirect()->back()->with('message', 'Byla vytvořena objednávka.');
        return redirect($response->json["gw_url"]);
        //return view('thanks');
    }
}
