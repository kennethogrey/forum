<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\User;

class FrontendController extends Controller
{
    public function index(){
        $forumsCount = count(Forum::all());
        $topicsCount = count(Topic::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());
        $categories  = Category::latest()->get();
        return view('welcome',compact('categories','forumsCount','topicsCount','newest','totalMembers','totalCategories'));
    }

    public function categoryOverview($id){
        $category = Category::find($id);
        return view('client.category-overview',compact('category'));
    }

    public function forumOverview($id){
        $forum = Forum::find($id);
        return view('client.forum-overview',compact('forum'));
    }
}
