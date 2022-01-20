<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;
use Illuminate\Support\Facades\Http;
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


            $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => env('FAKTUROID_APP_CONTACT'),
            ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME')  . '/subjects.json', [
                "name" => $order->email,
            ]);

            $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => env('FAKTUROID_APP_CONTACT'),
            ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices.json', [
                "subject_id" => json_decode($response->body())->id,
                "client_name" => env('FAKTUROID_NAME'),
                "proforma" => true,
                "invoice_paid" => true,
                "paid_amount" => "200.0",
                "lines" => [
                    "name" => "test",
                    "quantity" => "1",
                    "unit_price" => "200.0",
                ],
            ]);

            $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => env('FAKTUROID_APP_CONTACT'),
            ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices/' . json_decode($response->body())->id . '/fire.json?event=pay_proforma');
        }
    }
}
