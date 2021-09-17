<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageTexts;
use Illuminate\Support\Facades\Validator;

class PageTextsController extends Controller
{
    public $pageTexts;

    public function __construct()
    {
        $this->pageTexts = PageTexts::class;
    }

    public function index()
    {
        $pageTexts = $this->pageTexts::get();

        return view('page-texts.index', ['pageTexts' => $pageTexts]);
    }

    public function edit($uuid)
    {
        $pageText = $this->pageTexts::where('uuid', $uuid)->first();

        return view('page-texts.edit', ['pageText' => $pageText]);
    }

    public function update(Request $request, PageTexts $pageText)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'name' => [
                    'required',
                    'max:100',
                ],
                'text' => [
                    'required',
                ],
            ],
        )->validate();


        $pageText->name = $request->name;
        $pageText->text = $request->text;

        $pageText->save();

        return redirect('/admin/page-texts')->with('message', 'Stránka byla úspěšně editována.');
    }
}
