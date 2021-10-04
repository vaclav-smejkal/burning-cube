<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageTexts;

class ContactController extends Controller
{
    public function index()
    {
        $pageText = PageTexts::where('name', 'Kontakty')->first();

        return view('contact', ['pageText' => $pageText]);
    }
}
