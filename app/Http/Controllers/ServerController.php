<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ServerController extends Controller
{
    public $server;

    public function __construct()
    {
        $this->server = Server::class;
    }

    public function index()
    {
        $servers = $this->server::get();

        return view("server.index", ["servers" => $servers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'name' => [
                    'required',
                    'max:100',
                    'unique:servers',
                ],
                'ip_address' => [
                    'required',
                    'ip',
                ],
                'port' => [
                    'required',
                    'numeric',
                ],
            ],
            $messages = [
                "ip_address.required" => "Zadejte ip adresu.",
                "ip_address.ip" => "Zadejte Ip adresu ve správném formátu."
            ]
        )->validate();

        $this->server::create([
            'name' => $request->name,
            'sanitized_name' => Helper::instance()->friendly_url($request->name),
            'ip_address' => $request->ip_address,
            'port' => $request->port,
        ]);

        return redirect('/admin/server')->with('message', 'Server byl úspěšně vytvořen.');
    }

    public function edit($sanitized_name)
    {
        $server = $this->server::where('sanitized_name', $sanitized_name)->first();

        return view('server.edit', ['server' => $server]);
    }

    public function update(Request $request, Server $server)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'name' => [
                    'required',
                    'max:100',
                ],
                'ip_address' => [
                    'required',
                    'ip',
                ],
                'port' => [
                    'required',
                    'numeric',
                ],
            ],
            $messages = [
                "ip_address.required" => "Zadejte Ip adresu.",
                "ip_address.ip" => "Zadejte Ip adresu ve správném formátu."
            ]
        )->validate();

        $sanitizedName = Helper::instance()->friendly_url($request->name);

        $foundServer = $this->server::where('sanitized_name', $sanitizedName)->first();

        if ($foundServer && $foundServer->name != $server->name) {
            throw ValidationException::withMessages(['name' => 'Tento server již existuje.']);
        } else {
            $server->name = $request->name;
            $server->sanitized_name = Helper::instance()->friendly_url($request->name);
            $server->ip_address = $request->ip_address;
            $server->port = $request->port;

            $server->save();

            return redirect('/admin/server')->with('message', 'Server byl úspěšně editován.');
        }
    }

    public function destroy($sanitized_name)
    {
        $server = $this->server::where('sanitized_name', $sanitized_name)->first();
        $server->delete();

        return redirect("/admin/server");
    }
}
