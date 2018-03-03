<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view("post.index", compact('posts'));
    }

    public function postIndex(Request $request)
    {
        // TODO:validationが適当
        $this->validate($request, [
            'content' => 'required|max:255',
        ]);

        $data = $request->only('content');

//        if (! $data)
//            return redirect()->route('admin.user.create');

        // update
        $post = new Post();
        $post->fill($data)->save();

        return back();
    }

    public function postIndex2(Request $request)
    {
        // TODO:validationが適当
//        $this->validate($request, [
//            'content' => 'required|max:255',
//        ]);
//
//        $data = $request->only('content');
//
//        // update
//        $post = new Post();
//        $post->fill($data)->save();
//
//        return back();

        $validator = Validator::make($request->all(), [
            'content' => 'required|max:255',
        ]);

        if ($validator->passes()) {

            // Store your user in database
            $data = $request->only( 'content');
            $post = new Post();
            $post->fill($data)->save(); //forceFillもある

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }
}
