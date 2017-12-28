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
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class GameReportService extends Service{
    private $gameDaily;
    private $gameMonthly;
    private $payment;
    private $user;
    private $gameSessionModel;

    public function __construct(
        GameAgency $gameMonthlyReport,
        GameDailyReport $gameDailyReport,
        Payment $payment,
        User $user,
        GameSessionTracker $gameSessionModel
    )
    {
        $this->gameDaily = $gameDailyReport;
        $this->gameMonthly = $gameMonthlyReport;
        $this->payment = $payment;
        $this->user = $user;
        $this->gameSessionModel = $gameSessionModel;
    }

    public function getCurrentActiveUser($per_page = 15){
        return $this->user->where([
            'is_online' => 1
        ])->paginate($per_page);
    }

    public function getDailyActiveUser(Request $request, $getOne = false, $per_page = 15){
        $data = $request->only([
            'day_report',
            'game_id'
        ]);

        if($getOne) {
            $this->gameDaily->where($data)->first();
        }

        return $this->gameDaily->where($data)->paginate($per_page);
    }

    public function getMonthlyActiveUser(Request $request, $getOne = false, $per_page = 15){
        $data = $request->only([
            'monthly_report',
            'game_id'
        ]);

        if($getOne) {
            $this->gameMonthly->where($data)->first();
        }

        return $this->gameMonthly->where($data)->paginate($per_page);
    }

    public function getActiveUser(Request $request, $getOne = false, $per_page = 15){
        $data = $request->only([
            'user_id',
            'game_id',
            'pay_card_type',
            'login_date',
            'logout_date'
        ]);

        $loginDate = $data['login_at'] ? $data['login_at'] : Carbon::now();

        $query = $this->gameSessionModel
            ->whereDate('login_at', '<=', $loginDate);
        if($data['logout_date']) {
            $query->whereDate('logout_at', '>=', $data['logout_date']);
        } else {
            $query->whereNull('logout_at');
        }

        if($getOne){
            return $query->first();
        }

        return $query->paginate($per_page);
    }

    public function getPaymentGame(Request $request, $getOne = false, $per_page = 15){
        $data = $request->only([
            'user_id',
            'game_id',
            'pay_card_type',
            'start_date',
            'end_date'
        ]);

        $query = $this->payment
            ->sum('pay_price')
            ->whereDate('created_at', '>=', $data['start_date'])
            ->whereDate('created_at', '<=', $data['end_date'])
            ->groupBy('game_id')
            ->having($data);

        if($getOne){
            return $query->first();
        }

        return $query->paginate($per_page);
    }
}