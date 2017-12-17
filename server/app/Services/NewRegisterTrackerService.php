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
use App\Models\GameMonthlyReport;
use App\Models\GameSessionTracker;
use App\Models\NewRegisterTracker;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class NewRegisterTrackerService extends Service{
    private $newRegisterTracker;

    public function __construct(
        NewRegisterTracker $newRegisterTracker
    )
    {
        $this->newRegisterTracker = $newRegisterTracker;
    }

    public function addNewRegister(){
        $data = [
            'game_id' => Auth::user()->id,
            'user_id' => Auth::user()->game_id,
            'agency_id' => Auth::user()->agency_id,
        ];

        return $this->newRegisterTracker->firstOrCreate($data);
    }
}