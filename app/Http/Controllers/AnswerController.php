<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Carbon\Carbon;
use Illuminate\Http\Request;

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

        if ($request->has('submit')) {

            // @TODO:  get current user id
            Answer::create([
                'user_id' => 1, 
                'question_id' => $request->qid,
                'content' => $request->content,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $status = $request->hide ? 3 : 1;

            Question::find($request->qid)->update([
                'status_id' => $status,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('question.index');
        }

        return view('answer.create', [
            'q' => $q,
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
