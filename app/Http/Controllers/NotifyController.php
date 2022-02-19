<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use App\Models\Order;
use DateTime;
use Illuminate\Support\Facades\Mail;
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
            //'gatewayUrl' => 'https://gw.sandbox.gopay.com/api',
            'gatewayUrl' => 'https://gate.gopay.cz/api',
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

            if ($order->state === "PAID") {
                // $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                //     'Content-Type' => 'application/json',
                //     'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                // ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME')  . '/subjects.json', [
                //     "name" => "Drobný prodej",
                //     "email" => "vtesar2003@gmail.com",
                // ]);
                // dd(json_decode($response->body()));

                $subjectId = 13730500;
                $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                ])->patch('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME')  . '/subjects/' . $subjectId . '.json', [
                    "email" => $order->email,
                ]);

                $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices.json', [
                    "subject_id" => $subjectId,
                    "client_name" => env('FAKTUROID_NAME'),
                    "proforma" => true,
                    "invoice_paid" => true,
                    "paid_amount" => $order->price,
                    "lines" => [
                        "name" => "AfterLife balíček " . $order->package->name . " (" . $order->nickname . ". " . $order->email . ")",
                        "quantity" => "1",
                        "unit_price" => $order->price,
                    ],
                ]);

                $id = json_decode($response->body())->id;

                // $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                //     'Content-Type' => 'application/json',
                //     'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                // ])->get('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices/' . $id . '/download.pdf');

                $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices/' . $id . '/fire.json?event=pay_proforma');

                $response = Http::withBasicAuth(env('FAKTUROID_EMAIL'), env('FAKTUROID_API_KEY'))->withHeaders([
                    'Content-Type' => 'application/json',
                    'User-Agent' => env('FAKTUROID_APP_CONTACT'),
                ])->post('https://app.fakturoid.cz/api/v2/accounts/' . env('FAKTUROID_NAME') . '/invoices/' . $id . '/fire.json?event=deliver');

                $emailTemplate = Email::where('template', 'Objednavka')->first();
                Mail::send('email.email', ['body' => $emailTemplate->body], function ($message) use ($order, $emailTemplate) {
                    $message->to($order->email, $order->nickname);
                    $message->subject($emailTemplate->subject);
                    $message->from('web@burningcube.eu', 'After-life');
                });
            }
        }
    }
}
