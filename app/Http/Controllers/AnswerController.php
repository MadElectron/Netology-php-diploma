<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $q = Question::find($request->id);

        return view('answer.create', compact('q'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $a = Answer::create([
            'user_id' => $user->id, 
            'question_id' => $request->qid,
            'content' => $request->content,
        ]);

        $status = $request->hide ? 3 : 1;

       $a->question->update([
            'status_id' => $status,
        ]);

        Log::info(Auth::user()->name." добавил ответ ({$a->id}) на вопрос \"{$a->question->content}\" ({$a->question->id})");

        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $a = Answer::find($id);

        if ($a->question->status->id == 1) {
            $a->question->update([
                'status_id' => 2,
            ]);
        }

        $a->delete();

        Log::info(Auth::user()->name." удалил ответ ({$a->id}) на вопрос \"{$a->question->content}\" ({$a->question->id})");

        return redirect()->route('question.index');
    }
}
