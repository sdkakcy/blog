<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $categories = Category::with('childrenRecursive')->whereNull('parent_id')->get();

        return view('home', compact('posts', 'categories'));
    }
}
