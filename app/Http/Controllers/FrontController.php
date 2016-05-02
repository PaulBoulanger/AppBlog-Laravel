<?php

namespace App\Http\Controllers;

use View;
use App\Post;
use App\User;
use App\Category;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $key = 'home' . $request->get('page');
        if (Cache::has($key)) {
            $posts = Cache::get($key);
        }
    else
        {
            $posts = Post::with('category', 'user', 'tags', 'picture')->paginate(5);
            $expire = Carbon::now()->addMinutes(1);
            Cache::put($key, $posts, $expire);
        }

        return view('front.index', compact('posts', 'title'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $title=$post->title;

        return view('front.show', compact('post', 'title'));
    }
    public function userPost($id)
    {
        $posts = User::findOrFail($id)->posts;
        $user = User::findOrFail($id);

        return view('front.index', compact('posts', 'user'));
    }
    public function showPostByCat($id)
    {
        $category = Category::findOrFail($id);
        $posts = Post::with('category', 'user', 'tags', 'picture')->category($category->id)->published()->paginate(10);
        $title = $category->title;

        return view('front.category', compact('posts', 'title', 'category'));
    }
}
