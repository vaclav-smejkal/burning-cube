<?php

namespace App\Http\Controllers;

use App\Models\PageTexts;
use Illuminate\Http\Request;

class VOPController extends Controller
{
    public function index()
    {
        $pageText = PageTexts::where('name', 'vop')->first();

        return view('vop', ['pageText' => $pageText]);
    }
}
