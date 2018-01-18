<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use App\Question;

use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        return view('question.index', [
            'questions' => $questions
        ]);
    }

    /**
     * Display a listing of the resource by category.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByCategory($id)
    {
        $questions = Question::where(['category_id' => $id])->get();
        $c = Category::find($id);

        return view('question.index', [
            'category' => $c,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();

        if ($request->has('submit')) {


            Question::create([
                'author_name' => $request->name,
                'author_email' => $request->email,
                'category_id' => $request->category,
                'content' => $request->content,
                'status_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('index');
        }

        return view('question.create', [
            'categories' => $categories
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
    public function edit(Request $request, $id)
    {
        $q = Question::find($id);
        $categories = Category::all();

        if ($request->has('submit')) {

            if ($request->status) {
                $status = 3;
            } elseif ($q->answer) {
                $status = 1;
            } else $status = 2;

            $q->update([
                'author_name' => $request->name,
                'author_email' => $request->email,
                'category_id' => $request->category,
                'content' => $request->qcontent,
                'status_id' => $status,
                'updated_at' => Carbon::now(),
            ]);

            $q->answer->update([
                'content' => $request->acontent,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('question.index');
        }

        return view('question.edit', [
            'q' => $q, 
            'categories' => $categories,
        ]); 
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
        $q = Question::find($id);

        $q->delete();

        return redirect()->route('question.index');
    }

    /**
     * Hide the specify question
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hide($id)
    {
        $q = Question::find($id);

        // if not hidden hide (3)
        // else if has answer  then publish (2)
        // else set pending (1)

        if ($q->status->id != 3) {
            $status = 3;
        } elseif ($q->answer) {
            $status = 1;
        } else $status = 2;

        $q->update([
            'status_id' => $status,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('question.index');
    }
}
