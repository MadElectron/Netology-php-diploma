<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use App\Question;

use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('create');
    }

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
    public function create()
    {
        $categories = Category::all();

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
        Question::create([
            'author_name' => $request->name,
            'author_email' => $request->email,
            'category_id' => $request->category,
            'content' => $request->content,
            'status_id' => 2,
        ]);

        return redirect()->route('index');
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
        $q = Question::find($id);
        $categories = Category::all();

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
        $q = Question::find($id);

        if ($request->status) {
            $status = 3;
        } elseif ($q->answer) {
            $status = 1;
        } else {
            $status = 2;
        }

        $q->update([
            'author_name' => $request->name,
            'author_email' => $request->email,
            'category_id' => $request->category,
            'content' => $request->qcontent,
            'status_id' => $status,
        ]);

        if ($q->answer) {
            $q->answer->update([
                'content' => $request->acontent,
            ]);
        }
        

        return redirect()->route('question.index');
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
        // else if has answer then publish (1)
        // else set pending (2)

        if ($q->status->id != 3) {
            $status = 3;
        } elseif ($q->answer) {
            $status = 1;
        } else {
            $status = 2;
        }

        $q->update([
            'status_id' => $status,
        ]);

        return redirect()->route('question.index');
    }
}
