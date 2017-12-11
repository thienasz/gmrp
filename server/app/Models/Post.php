<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    protected $table = 'post';

    protected $fillable = [
        'post_name','categoryID','typeID','content_post','avatar','describe','status',
    ];

    public function postModel(){
        $postModel = new Post();
        return $postModel;
    }

    public function getSinglePost($postID){
        $post = $this->postModel()->where('postID',$postID)->first();
        return $post;
    }

    public function getAllPost(){
        $posts = $this->postModel()->get();
        return $posts;
    }

    public function deletePost($postID){
        $deletePost = $this->postModel()->where('postID',$postID)->delete();
        return $deletePost;
    }

    public function createPost(Request $request){
        $postCreated = $this->postModel()->create([
            'post_name' => $request->post_name,
            'categoryID' => $request->categoryID,
            'typeID' => $request->typeID,
            'content_post' => $request->content_post,
            'avatar' => url('/').str_replace(
            'public',
            '/storage',
            $request->file('avatar')->store('public/post')),
            'describe' => $request->describe,
        ]);

        return $postCreated;
    }

    public function updatePost(Request $request, $postID){
        $postUpdated = $this->postModel()
            ->where('postID',$postID)
            ->update([
                'post_name' => $request->post_name,
                'categoryID' => $request->categoryID,
                'typeID' => $request->typeID,
                'content_post' => $request->content_post,
                'avatar' => url('/').str_replace(
                        'public',
                        '/storage',
                        $request->file('avatar')->store('public/post')),
                'describe' => $request->describe,
                'status' => $request->status
            ]);

        return $postUpdated;
    }

    public function getAvatarUrl($postID){
        $url = $this->postModel()->where('postID',$postID)->value('avatar');
        return $url;
    }
}
