<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(){
        return response(["data"=>$this->postService->getAllPost()]);
    }

    public function show($postID){
        //Check post exits
        $post = $this->postService->getSinglePost($postID);
        if (!$post)
            return response()->json(["Message"=>"Post does not exits."]);

        return response()->json(["data"=>$post]);
    }

    public function store(Request $request){
        //Validate
        $validate = Validator::make($request->all(),[
            'post_name' => 'required',
            'categoryID' => 'required',
            'typeID' => 'required',
            'content_post' => 'required',
            'avatar' => 'required',
            'describe' => 'required'
        ]);
        if ($validate->fails())
            return response()->json(["Error"=>$validate->errors()]);

        $post = $this->postService->createPost($request);

        if (!$post)
            return response()->json(["Message"=>"Failed to create new post."]);

        return response()->json(["data"=>$post]);
    }

    public function update(Request $request,$postID){
        //Validate
        $validate = Validator::make($request->all(),[
            'post_name' => 'required',
            'categoryID' => 'required',
            'typeID' => 'required',
            'content_post' => 'required',
            'avatar' => 'required',
            'describe' => 'required'
        ]);
        if ($validate->fails())
            return response()->json(["Error"=>$validate->errors()]);

        //Check post exits
        $post = $this->postService->getSinglePost($postID);
        if (!$post)
            return response()->json(["Message"=>"Post does not exists."]);

        //Delete avatar before update new avatar
        $deleteOldAvatarImage = $this->postService->deleteAvatarImageBeforeUpdate($postID);

        if (!$deleteOldAvatarImage)
            return response()->json(["Message"=>"Cannot delete old avatar image"]);

        $updatePost = $this->postService->updatePost($request,$postID);

        if (!$updatePost)
            return response()->json(["Message"=>"Failed to update post."]);

        $post = $this->postService->getSinglePost($postID);

        return response()->json(["Message"=>"Post updated successfully.","data"=>$post],200);
    }

    public function delete($postID){
        //Check post exits
        $post = $this->postService->getSinglePost($postID);
        if (!$post)
            return response()->json(["Message"=>"Post does not exists."]);

        //Delete Post's Image
        $deleteOldAvatarImage = $this->postService->deleteAvatarImageBeforeUpdate($postID);
        if (!$deleteOldAvatarImage)
            return response()->json(["Message"=>"Cannot delete old avatar image"]);

        $postDeleted = $this->postService->deletePost($postID);

        if (!$postDeleted)
            response()->json(["Message"=>"Failed to delete post."]);

        return response()->json(["Message"=>"Post deleted successfully"],200);
    }
}
