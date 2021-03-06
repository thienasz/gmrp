<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Game;
use App\Models\GameDailyReport;
use App\Models\GameAgency;
use App\Models\GameSessionTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

class GameSessionTrackerService extends Service{
    private $gameSessionModel;
    private $gameDaily;
    private $gameMonthly;

    public function __construct(
        GameSessionTracker $gameSessionModel,
        GameAgency $gameAgency
    )
    {
        $this->gameSessionModel = $gameSessionModel;
//        $this->gameDaily = $gameDailyReport;
        $this->gameMonthly = $gameAgency;
    }

    public function getAllGame($perPage = 15){
        return $this->gameSessionModel->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getSingleGame($postID){
        return $this->gameSessionModel->find($postID);
    }

    public function deleteGame($postID){
        return $this->gameSessionModel->delete($postID);
    }

    public function startGameSession(Request $request){
        $data = $request->only([
            'last_activity',
            'ip',
            'os_type',
            'os_version',
            'device_uid',
            'location'
        ]);

        $data['game_id'] = Auth::user()->game_id;
        $data['agency_id'] = Auth::user()->agency_id;
        $data['user_id'] = Auth::user()->id;
        $data['is_online'] = 1;
        $data['login_at'] = \Carbon\Carbon::now();

        $data['os_type'] = $request['os_type'];
                $data['os_version'] = $request['os_version'];
                $data['device_uid'] = $request['device_uid'];
//        $data['login_code'] = encrypt(implode('-', [$data['game_id'], $data['user_id'], $data['login_at']]));

        return $this->gameSessionModel->create($data);
    }

    public function endGameSession(){

        $session = $this->gameSessionModel->where([
                'game_id' => Auth::user()->game_id,
                'user_id' => Auth::user()->id,
                'agency_id' => Auth::user()->agency_id,
                'is_online' => 1,
            ])->whereNull('logout_at')->first();
        if(!$session) {
            return null;
//            throw new Exception('Session not found');
        }
        $data = [
            'game_id' => Auth::user()->game_id,
            'user_id' => Auth::user()->id,
            'logout_at' => \Carbon\Carbon::now(),
            'is_online' => 0,
        ];

        return $session->update($data);
    }
}