<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Game;
use Illuminate\Http\Request;

class GameService extends Service{
    private $gameModel;

    public function __construct(Game $gameModel)
    {
        $this->gameModel = $gameModel;
    }

    public function getAllGame($perPage = 15){
        return $this->gameModel->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getSingleGame($postID){
        return $this->gameModel->find($postID);
    }

    public function deleteGame($postID){
        return $this->gameModel->delete($postID);
    }

    public function createGame(Request $request){
        $data = $request->only(['id', 'name', 'description']);
        return $this->gameModel->updateOrCreate([
            'id' => $data['id']
        ], $data);
    }

    public function updateGame(Request $request, $postID){
        $data = $request;
        return $this->gameModel->update($data, $postID);
    }
}