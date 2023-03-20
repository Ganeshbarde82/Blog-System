<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Comments\CreateRequest;
use App\Http\Requests\Site\Comments\Reply\CreateRequest as ReplyCreateRequest;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function postComment(CreateRequest $request, $postId)
    {
        if(auth()->check()){
            $post = Post::find($postId);
            
            if(! $post){
                return back()->withErrors('unable to find the post , please refresh the webpage ');
            }
        

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);

        $request->session()->flash('alert-success', 'comment added successfully, it will be visible after admin approval ');
    }

    return back();

}
    public function postCommentReply(ReplyCreateRequest  $request, $commentId)
    {
        $commentId = $commentId;
        $comment = $request->comment;
       // dd($commentId);

       try{
        CommentReply::create([
            'comment_id' => $commentId,
            'user_id'  => auth()->id(),
            'comment' =>$comment
        ]);
    }
    catch(\Exception $ex){
        return back()->withErrors($ex->getMessage());
    }
        $request->session()->flash('alert-success', 'Reply added successfully ');
        return back();

    }

    public function deleteCommentReply(Request $request){
        $replyId = $request->reply_id;

        $reply = CommentReply::find($replyId);

            if(! $reply){
                return back()->withErrors('unable to locate the reply, please refresh the webpage , it still problem persistence, contect the adminastration');
            }

            $reply->delete();
            $request->session()->flash('alert-success', 'deleted successfully ');
            return back();
    }
    
}