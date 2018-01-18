<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Question;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return redirect()->route('index.category',['id' => 1]);
    }

    public function indexCategory($id)
    {
        $category = Category::find($id);
        $categories = Category::all();

        return view('index',[
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
