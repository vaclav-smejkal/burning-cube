<?php

namespace App\Http\Controllers;

use App\Models\PageTexts;
use Illuminate\Http\Request;

class HowToDoItController extends Controller
{
    public function index()
    {
        $pageText = PageTexts::where('name', 'Jak na to?')->first();

        return view("how-to-do-it", ["pageText" => $pageText]);
    }
}
