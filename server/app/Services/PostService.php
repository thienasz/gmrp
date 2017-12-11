<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService extends Service{
    private $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function getAllPost(){
        return $this->postModel->getAllPost();
    }

    public function getSinglePost($postID){
        return $this->postModel->getSinglePost($postID);
    }

    public function deletePost($postID){
        return $this->postModel->deletePost($postID);
    }

    public function createPost(Request $request){
        return $this->postModel->createPost($request);
    }

    public function updatePost(Request $request, $postID){
        return $this->postModel->updatePost($request, $postID);
    }

    public function deleteAvatarImageBeforeUpdate($postID){
        $avatarUrl = $this->postModel->getAvatarUrl($postID);

        //Get image name from URL
        $urlArray = explode('/',$avatarUrl);

        //Get last item in array
        $avatar = end($urlArray);

        try{
            $delete = unlink(public_path('storage\post\\'.$avatar));

            return $delete;
        }catch (Exception $ex){
            return $ex;
        }
    }
}