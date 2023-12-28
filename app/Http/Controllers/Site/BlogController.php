<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
         $blogs = Post::where('status',Post::PUBLISHED)->Paginate(6);                   //paginate(2)
      // $blogs = Post::all();
        return view('site.index', compact('blogs'));
    }
    public function openSingle($id){
        $blog = Post::find($id);
        
        if(! $blog){
            abort(404);
        }
         $comments = Comment::where('post_id', $blog->id)->Paginate(4);
       // $comments = Comment::where('post_id', $blog->id)->get();
       // $comments = Comment::all();
      // $latestPosts = Post::where('id', '!=', $blog->id)->latest()->limit(5)->get();
      $latestPosts = Post::where('id', $blog->id)->latest()->limit(5)->get();
       $tags= $blog->tags;
      // dd($tags);
        return view('site.single',compact('blog', 'comments','latestPosts','tags'));
    }
}
