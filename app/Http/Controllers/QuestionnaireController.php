<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('questionnaire.create');
    }

    public function store()
    {
        $data=request()->validate([
            'title'=>'required',
            'purpose'=>'required',
        ]);
        $questionnaire=auth()->user()->questionnaire()->create($data);
        return redirect('questionnaires/'.$questionnaire->id);
    }

    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses');
//        dd($questionnaire);
        return view('questionnaire.show',compact('questionnaire'));

    }
}
