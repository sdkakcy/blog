<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user'])->get();

        return view('panel.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getTree();
        
        return view('panel.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'category' => 'required|array|min:1',
            'content' => 'nullable|string',
        ]);


        try {
            $post = new Post();
            $post->user_id = $request->user()->id;
            $post->subject = $request->subject;
            $post->slug = Str::slug($request->subject);
            $post->content = $request->content;

            $post->save();

            $post->categories()->sync($request->category);

            return redirect()->route('panel.posts.index')->with([
                'status' => [
                    'success' => true,
                    'message' => __('Yazı eklendi')
                ]
            ]);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with(['status' => $result])->withInput();
        }
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
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::getTree();

        $post->loadMissing('categories');

        return view('panel.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'subject' => 'required|string',
            'category' => 'required|array|min:1',
            'content' => 'nullable|string',
        ]);


        try {
            $post->subject = $request->subject;
            $post->slug = Str::slug($request->subject);
            $post->content = $request->content;

            $post->update();

            $post->categories()->sync($request->category);

            return redirect()->back()->with([
                'status' => [
                    'success' => true,
                    'message' => __('Yazı güncellendi')
                ]
            ]);
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with(['status' => $result])->withInput();
        }
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
