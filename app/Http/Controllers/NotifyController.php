<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use GoPay;

class NotifyController extends Controller
{
    public function __construct()
    {
        $this->order = Order::class;
    }


    public function index(Request $request)
    {
        $gopay =  GoPay\payments([
            'goid' => config('gopay.goid'),
            'clientId' => config('gopay.client_id'),
            'clientSecret' => config('gopay.client_secret'),
            'gatewayUrl' => 'https://gw.sandbox.gopay.com/',
            'scope' => GoPay\Definition\TokenScope::ALL,
            'language' => GoPay\Definition\Language::CZECH,
            'timeout' => 30
        ]);

        $params = $request->all();
        if (!empty($params)) {
            $json = $gopay->getStatus(($params['id']))->json;
            $order = $this->order::where('uuid', $json['order_number'])->first();
            $order->state = $json['state'];
            $order->save();
        }
    }
}
