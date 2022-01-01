<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoPay;

class NotifyController extends Controller
{
    public function index(Request $request)
    {
        $gopay =  GoPay\payments([
            'goid' => env('GOID'),
            'clientId' => env('CLIENT_ID'),
            'clientSecret' => env('CLIENT_SECRET'),
            'gatewayUrl' => 'https://gw.sandbox.gopay.com/',
            'scope' => GoPay\Definition\TokenScope::ALL,
            'language' => GoPay\Definition\Language::CZECH,
            'timeout' => 30
        ]);

        $params = $request->all();
        $response = $gopay->getStatus(($params['id']));
        $message = $response->json['errors'][0]['message'];

        return view('notify', ['message' => $message]);
    }
}
