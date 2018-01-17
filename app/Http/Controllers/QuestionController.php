<?php

namespace App\Http\Controllers;

use App\Category;
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
        $questions = Question::find(['category' => $id]);

        return view('question.index', [
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
                'category' => $request->category,
                'content' => $request->content,
                'status' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('question.index');
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

    /**
     * Hide the specify question
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hide($id)
    {
        $user = Question::find($id);

        $user->delete();

        return redirect()->route('question.index');
    }
}
