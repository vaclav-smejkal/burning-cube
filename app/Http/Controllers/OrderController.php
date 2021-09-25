<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'email' => [
                    'required',
                    'email',
                ],
                'nickname' => [
                    'required',
                    'max:100',
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
            ],
            $messages = [
                "psc.regex" => "Zadejte správný formát PSČ",
            ]
        )->validate();

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
