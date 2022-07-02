<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view category'), 403);

        $categories = Category::getTree();

        return view('panel.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create category'), 403);

        $categories = Category::getTree();

        return view('panel.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create category'), 403);

        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|integer'
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->parent_id = $request->parent_id;

            $category->save();

            return redirect()->route('panel.categories.index')->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kategori eklendi')
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort_if(!auth()->user()->can('update category'), 403);

        $categories = Category::getTree()->where('id', '!=', $category->id);

        return view('panel.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        abort_if(!auth()->user()->can('update category'), 403);

        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|integer'
        ]);

        try {
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->parent_id = $request->parent_id;

            $category->update();

            return redirect()->back()->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kategori güncellendi')
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        abort_if(!auth()->user()->can('delete category'), 403);

        try {
            $category->delete();

            return redirect()->back()->with([
                'status' => [
                    'success' => true,
                    'message' => __('Kategori silindi')
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
}
