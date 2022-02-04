<?php

namespace App\Http\Controllers;

use GoPay\Definition\Language;
use GoPay\Definition\Payment\Currency;
use GoPay\Definition\Payment\PaymentInstrument;
use GoPay\Definition\Payment\VatRate;
use App\Models\Package;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use GoPay;
use Illuminate\Support\Env;
use Config;
use DateTime;

class OrderController extends Controller
{
    public $order;
    public function __construct()
    {
        $this->order = Order::class;
    }

    public function show($sanitized_name, Request $request)
    {
        $package = Package::where('sanitized_name', $sanitized_name)->first();

        $gopay =  GoPay\payments([
            'goid' => config('gopay.goid'),
            'clientId' => config('gopay.client_id'),
            'clientSecret' => config('gopay.client_secret'),
            'gatewayUrl' => 'https://gate.gopay.cz/api',
            'scope' => GoPay\Definition\TokenScope::ALL,
            'language' => GoPay\Definition\Language::CZECH,
            'timeout' => 30
        ]);

        $gopayMessage = "";
        $success = false;
        $params = $request->all();

        if (!empty($params)) {
            $response = $gopay->getStatus(($params['id']));

            if (isset($response->json['errors'])) {
                $gopayMessage = $response->json['errors'][0]['message'];
            } elseif (isset($response->json['state'])) {
                switch ($response->json['state']) {
                    case 'PAID':
                        $success = true;
                        $gopayMessage = 'Objednávka je zaplacena.';
                        break;
                    case 'CREATED':
                        $success = true;
                        $gopayMessage = 'Objednávka je vytvořena, ale není zaplacena.';
                        break;
                }
            }

            return view('order.show', ['package' => $package, 'gopayMessage' => $gopayMessage, 'success' => $success, 'paymentUUID' => $response->json["order_number"]]);
        }

        return view('order.show', ['package' => $package]);
    }

    public function store(Request $request)
    {
        $gopay =  GoPay\payments([
            'goid' => config('gopay.goid'),
            'clientId' => config('gopay.client_id'),
            'clientSecret' => config('gopay.client_secret'),
            'gatewayUrl' => 'https://gate.gopay.cz/api',
            'scope' => GoPay\Definition\TokenScope::ALL,
            'language' => GoPay\Definition\Language::CZECH,
            'timeout' => 30
        ]);

        $package = Package::where("sanitized_name", $request->package_sanitized_name)->first();

        if (!$package) {
            throw ValidationException::withMessages(['package_sanitized_name' => "Tento balíček neexistuje."]);
        }

        $newPrice = $package->price;
        $methods = [];
        switch ($request["payment-method"]) {
            case "gopay":
                $methods = [PaymentInstrument::PAYMENT_CARD, PaymentInstrument::BANK_ACCOUNT, PaymentInstrument::GPAY, PaymentInstrument::APPLE_PAY, PaymentInstrument::GOPAY, PaymentInstrument::MPAYMENT, PaymentInstrument::BITCOIN];
                break;
                // case "paysafe":
                //     $newPrice *= 1.13;
                //     $methods = [PaymentInstrument::PAYSAFECARD];
                //     break;
            case "sms":
                $methods = [PaymentInstrument::PREMIUM_SMS];
                $newPrice = $package->sms_price;
                break;
            default:
                throw ValidationException::withMessages(['payment-method' => "Zadali jste špatnou platební metodu."]);
                break;
        }

        $order = Order::where([['uuid', $request['payment-uuid']], ['state', '!=', 'PAID']])->first();
        if (!$order) {
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

            $order = Order::where([['nickname', $request->nickname], ['state', 'PAID']])->first();

            if ($order) {
                throw ValidationException::withMessages(['nickname' => "Tento nickname již někdo používá."]);
            }

            $response = $gopay->createPayment([
                'payer' => [
                    'allowed_payment_instruments' =>  $methods,
                    'contact' => [
                        'email' => $request->email,
                    ]
                ],
                'amount' => $newPrice * 100,
                'currency' => Currency::CZECH_CROWNS,
                'order_number' => Str::uuid(),
                'items' => [
                    [
                        'type' => 'ITEM',
                        'name' => $package->name,
                        'amount' => $newPrice * 100,
                        'count' => 1,
                        'vat_rate' => VatRate::RATE_4
                    ],
                ],
                'callback' => [
                    'return_url' => 'https://after-life.cz/order/' . $package->sanitized_name,
                    'notification_url' => 'https://after-life.cz/notify'
                ],
                'lang' => Language::CZECH
            ]);

            $newOrder = $this->order::create([
                'email' => $request->email,
                'nickname' => $request->nickname,
                'discord_tag' => $request["discord-tag"],
                'comment' => $request->comment,
                'state' => $response->json['state'],
                'price' => $newPrice,
                // 'name_surname' => $request->name_surname,
                // 'place' => $request->place,
                // 'psc' => $request->psc,
                'name_surname' => 'null',
                'place' => 'null',
                'psc' => 'null',
                'uuid' => $response->json['order_number'],
                'package_id' => $package->id
            ]);
        } else {
            $response = $gopay->createPayment([
                'payer' => [
                    'allowed_payment_instruments' => $methods,
                    'contact' => [
                        'email' => $request->email,
                    ]
                ],
                'amount' => $newPrice * 100,
                'currency' => Currency::CZECH_CROWNS,
                'order_number' => $order->uuid,
                'items' => [
                    [
                        'type' => 'ITEM',
                        'name' => $package->name,
                        'amount' => $newPrice * 100,
                        'count' => 1,
                        'vat_rate' => VatRate::RATE_4
                    ],
                ],
                'callback' => [
                    'return_url' => 'https://after-life.cz/order/' . $package->sanitized_name,
                    'notification_url' => 'https://after-life.cz/notify'
                ],
                'lang' => Language::CZECH
            ]);

            $order->price = $newPrice;
            $order->save();
        }

        return redirect($response->json['gw_url']);
    }
}
