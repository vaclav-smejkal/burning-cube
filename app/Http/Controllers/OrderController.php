<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($sanitized_name)
    {
        $package = Package::where('sanitized_name', $sanitized_name)->first();

        return view('order.show', ['package' => $package]);
    }
}
