<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.pages.categories',[
            'categories'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.new_category');
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
            'title'=> 'required',
            'image'=> 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'desc'=> 'required',
        ]);
        $image = $request->image;
        $name = $image->getClientOriginalName();
        $new_name = time().$name;
        $dir = "storage/images/categories/";
        $image->move($dir, $new_name);

        $category = new Category();
        $category->title = $request->title;
        $category->desc = $request->desc;
        $category->image = $new_name;
        $category->user_id = auth()->id();
        $category->save();
        Session::flash('message', 'Category Created Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.pages.single_category',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.edit_category',[
            'category'=>$category,
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
        $image='';
        $name = '';
        $new_name = '';
        $dir = '';
        if($request->image){
            $image = $request->image;
            $name = $image->getClientOriginalName();
            $new_name = time().$name;
            $dir = "storage/images/categories/";
            $image->move($dir, $new_name);
        }
        $category = Category::find($id);
        if($request->title){
            $category->title = $request->title;
        }
        if ($request->desc) {
            $category->desc = $request->desc;
        }
        if ($request->image) {
            $category->image = $new_name;
        }
        $category->save();
        Session::flash('message', 'Category Updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('message', 'Category Deleted Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
}
