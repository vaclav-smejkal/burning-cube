<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PageTexts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::get();
        $pageText = PageTexts::where('uuid', 'c1caebee-0896-48dd-9b06-6600cd68f961')->first();

        return view("front-page", ["packages" => $packages, 'pageText' => $pageText]);
    }
}
