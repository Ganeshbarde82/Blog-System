<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Posts\CreateRequest;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('auth.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('auth.posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    // public function store(Request $request)
    {
        // $request->validate([
        //     'title' =>['required','string','max:255'],          //custom rule pass y  // advance
        //     'description'=>['required','string','max:3000'],
        //     'status' =>['required','integer','max:255'],
        //     'category' =>['required','integer','max:255'],
        //     'tags' =>['required','array'],                    // check array
        //     'tags.*' =>['required','string','max:255']      // dot static

        // ]);



        // DB::beginTransaction();
        // DB::commit();
        // DB::rollBack()


        try {

      //  DB::transaction(function() use ($request)   // 1st clouser  using fasade
      //  {                                            // 1st clouser
            DB::beginTransaction(); 
            if ($file = $request->file('file')){
             
                $filName= $this->uploadFile($file);

                 $gallery = $this->storeImage($filName);
            } 
            //dd('dont have');
       
            $post =  Post::create([
                'gallery_id' => $gallery->id,
                'user_id'=> auth()->id(),   // login result return
                'title'=>$request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category,
    
            ]);
                                                        // multiple tags  post model
            foreach($request->tags as $tag) {
                $post->tags()->attach($tag);
            }                                          // seesion two type 1) put simple   2)flash  benfiet  only onece throw automatic expire
            DB::commit();
            $request->session()->flash('alert-success', 'Post Created Successfully');     // ('key' ,'value')
            return to_route('posts.index');
       // });                                           // 1st clouser
        } 
     catch (\Exception $ex) {
             DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }


     

        
      
        return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        return view('auth.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('auth.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        {
           
            if($file =$request->file('file')){

                 $imageName = null;
                if($post->gallery)
                {
                     $imageName = $post->gallery->image;

                      $imagePath = public_path('/storage/auth/posts/');
               // dd('yes');
               if(file_exists($imagePath. $imageName)){
                unlink($imagePath. $imageName);
                   // dd('yes');
               }
                }

             $filName = $this->uploadFile($file);
               $post->gallery->update([
                    'image' => $filName
               ]);
                $post->update([
               // 'gallery_id' => $gallery->id,
                'user_id'=> auth()->id(),   // login result return
                'title'=>$request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category,
        ]);
            }
            // else
            // {
            //     dd('no');
            // }
        }
       
        foreach($request->tags as $tag)  {
            $post->tags()->attach($tag);
        }

        $request->session()->flash('alert-success', 'Post Updated Successfully');
        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
   
        $post->tags()->detach();
        $post ->delete();
        request()->session()->flash('alert-success', 'Post Deleted Successfully');
        return to_route('posts.index');
        
    }

    private function uploadFile($file){
        $filName = rand(100, 1000000) . time(). $file->getClientOriginalName();
        $filePath = public_path('/storage/auth/posts/');
      //  $filewithPath = $filePath. $filName;
     //   dd($filewithPath);

     $file->move($filePath, $filName);     // move helper
        return $filName;
    }

    private function storeImage($filName){
        $gallery =  Gallery::create([
            'image' => $filName,
            'type'  => Gallery::POST_IMAGE
         ]);
         return $gallery;
    }

}
