<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    public $question;

    public function __construct()
    {
        $this->question = Question::class;
    }

    public function index()
    {
        $questions = $this->question::get();

        return view("question.index", ["questions" => $questions]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'question' => [
                    'required',
                    'unique:questions',
                ],
                'answer' => [
                    'required',
                ],
            ],
            $messages = [
                "question.required" => "Vyplňte otázku.",
            ]
        )->validate();

        $this->question::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'uuid' => Str::uuid(),
        ]);

        return redirect('/admin/question')->with('message', 'Otázka byla vytvořena.');
    }

    public function edit($uuid)
    {
        $question = $this->question::where('uuid', $uuid)->first();

        return view('question.edit', ['question' => $question]);
    }

    public function update(Request $request, Question $question)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'question' => [
                    'required',
                ],
                'answer' => [
                    'required',
                ],
            ],
            $messages = [
                "question.required" => "Vyplňte otázku.",
            ]
        )->validate();

        $foundQuestion = $this->question::where('question', $request->question)->first();

        if ($foundQuestion) {
            throw ValidationException::withMessages(['question' => 'Tato otázka již existuje.']);
        } else {
            $question->question = $request->question;
            $question->answer = $request->answer;

            $question->save();

            return redirect('/admin/question')->with('message', 'Otázka byla editována.');
        }
    }

    public function destroy($uuid)
    {
        $question = $this->question::where('uuid', $uuid)->first();
        $question->delete();

        return redirect("/admin/question");
    }
}
