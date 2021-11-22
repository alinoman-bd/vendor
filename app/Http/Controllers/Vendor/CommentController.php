<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\CommentReplay;
class CommentController extends Controller
{
    public function addComment(Request $request)
    {
    	$status = ($request->status == 'rec') ? 1 : 2;
    	$model = ($request->status == 'rec') ? '\App\Resource' : '\App\Entertainment';
    	$comment = new Comment();
    	$comment->rec_ent_id = $request->rec_ent_id;
    	$comment->name = $request->name;
    	$comment->email = $request->email;
    	$comment->star = $request->star;
    	$comment->comment = $request->comment;
    	$comment->status = $status;
    	$comment->save();
 		$data['resource'] = $model::with('user','comments.replay')->where('id',$request->rec_ent_id)->first();
    	$all_comments = view('vendor.review.review',$data)->render();
    	return response()->json(['all_comments'=>$all_comments]);
    }

    public function replay(Request $request)
    {
    	$replay = new CommentReplay();
    	$replay->comment_id = $request->comment_id;
    	$replay->name = $request->name;
    	$replay->email = $request->email;
    	$replay->comment = $request->comment;
    	$replay->save();
    	$status = ($request->status == 'rec') ? 1 : 2;
    	$model = ($request->status == 'rec') ? '\App\Resource' : '\App\Entertainment';

    	$data['resource'] = $model::with('user','comments.replay')->where('id',$request->rec_ent_id)->first();
    	$all_comments = view('vendor.review.review',$data)->render();
    	return response()->json(['all_comments'=>$all_comments]);

    }
}
