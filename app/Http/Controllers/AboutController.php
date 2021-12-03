<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageTexts;

class AboutController extends Controller
{
    public function index()
    {
        $pageText = PageTexts::where('name', 'ONas')->first();

        return view('about', ['pageText' => $pageText]);
    }
}
