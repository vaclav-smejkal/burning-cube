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
        $pageText = PageTexts::where('name', 'Úvodní stránka')->first();

        return view("front-page", ["packages" => $packages, 'pageText' => $pageText]);
    }
}
