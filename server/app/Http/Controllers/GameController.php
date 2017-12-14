<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class GameController extends Controller
{
    private $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index(){
        return response()->jsonOk($this->gameService->getAllGame());
    }

    public function show($gameID){
        //Check game exits
        $game = $this->gameService->getSingleGame($gameID);
        if (!$game)
            return response()->jsonError("Game does not exits.");

        return response()->json(["data"=>$game]);
    }

    public function store(Request $request){
        //Validate
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ]);

        $game = $this->gameService->createGame($request);

        return response()->jsonOk($game);
    }

    public function update(Request $request,$gameID){
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ]);

        //Check game exits
        $game = $this->gameService->getSingleGame($gameID);
        if (!$game)
            return response()->jsonError("Game does not exists.");

        $updateGame = $this->gameService->updateGame($request,$gameID);

        if (!$updateGame)
            return response()->jsonError(["Failed to update game."]);

        $game = $this->gameService->getSingleGame($gameID);

        return response()->jsonOk($game);
    }

    public function delete($gameID){
        //Check game exits
        $game = $this->gameService->getSingleGame($gameID);
        if (!$game)
            return response()->jsonError("Game does not exists.");

        $gameDeleted = $this->gameService->deleteGame($gameID);

        if (!$gameDeleted)
            response()->jsonError("Failed to delete game.");

        return response()->jsonOk("Game deleted successfully");
    }
}
