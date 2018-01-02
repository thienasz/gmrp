<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Agency;
use App\Models\Game;
use App\Models\GameSessionTracker;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportService extends Service{

    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var GameSessionTracker
     */
    private $gameSessionTracker;
    /**
     * @var NewRegisterTracker
     */
    private $newRegisterTracker;
    /**
     * @var Agency
     */
    private $agency;
    /**
     * @var Game
     */
    private $game;

    public function __construct(
        Payment $payment,
        GameSessionTracker $gameSessionTracker,
        Agency $agency,
    Game $game
    )
    {
        $this->payment = $payment;
        $this->gameSessionTracker = $gameSessionTracker;
        $this->agency = $agency;
        $this->game = $game;
    }

    public function revenue($startDate, $endDate, $agency_id = null)
    {
        $query = $this->payment
            ->with([
                'game' => function($q) use($startDate, $endDate, $agency_id) {
                    $q->withCount([
                        'registers' => function ($q) use ($startDate, $endDate, $agency_id) {
                            if($startDate) {
                                $q->whereDate('created_at', '>=', $startDate);
                            }

                            if($endDate) {
                                $q->whereDate('created_at', '<=', $endDate);
                            }

                            if($agency_id) {
                                $q->where('agency_id', $agency_id);
                            }
                        }]);
                }
            ]);

        if($agency_id) {
            $query->where('agency_id', $agency_id);
        }

        $query->groupBy('game_id')
            ->selectRaw('sum(pay_price) as sum_price, count(user_id) as user_count, game_id');

        if($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        return $query->get();
    }

    public function totalRevenue($startDate, $endDate)
    {
        $query = $this->payment
            ->selectRaw('sum(pay_price) as sum_price, count(user_id) as user_count');

        if($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        return $query->first();
    }

    public function accountReport($game, $month, $year, $activeTime = null)
    {
        $rs = [];
        if(!$activeTime) {
            $activeTime = Carbon::now();
        }
        $query = $this->gameSessionTracker
            ->whereDate('login_at', '<=', $activeTime)
            ->where(function ($query) use ($activeTime) {
                $query->whereDate('logout_at', '>=', $activeTime)
                    ->orWhereNull('logout_at');
            });

        if($game) {
            $query->where('game_id', $game);
        }

        $rs['ccu'] = $query->count();


        $query = $this->newRegisterTracker
                        ->whereDate('created_at', '>=', Carbon::yesterday());

        if($game) {
            $query->where('game_id', $game);
        }

        $rs['nru'] = $query->count();

        $query = $this->gameSessionTracker
                            ->distinct('user_id')
                            ->whereDate('login_at', '>=', Carbon::yesterday());
        if($game) {
            $query->where('game_id', $game);
        }

        $rs['dau'] = $query->count();

        $query = $this->gameSessionTracker
                            ->distinct('user_id')
                            ->whereMonth('login_at', $month)
                            ->whereYear('login_at', $year);
        if($game) {
            $query->where('game_id', $game);
        }

        $rs['mau'] = $query->count();

        $query = $this->newRegisterTracker
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        if($game) {
            $query->where('game_id', $game);
        }

        $rs['tru'] = $query->count();

        $rs['mlau'] = $rs['mau'] ? $rs['tru']/$rs['mau'] : 0;

        return $rs;
    }

    public function cardRevenue($startDate, $endDate)
    {
        $query = $this->payment
            ->with('paymentType')
            ->groupBy('pay_card_type')
            ->selectRaw('sum(pay_price) as sum_price, count(user_id) as user_count, pay_card_type');

        if($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        return $query->get();
    }

    public function agencyRevenue($startDate, $endDate, $agency_id)
    {
        return $this->revenue($startDate, $endDate, $agency_id);
    }

    public function agencyRevenuex($startDate, $endDate)
    {
        $query = $this->agency
            ->with(['payments' => function ($q) use ($startDate, $endDate) {
                if($startDate) {
                    $q->whereDate('created_at', '>=', $startDate);
                }

                if($endDate) {
                    $q->whereDate('created_at', '<=', $endDate);
                }
                $q->withCount([
                    'activity AS yoursum' => function ($query) {
                        $query->select(DB::raw("SUM(pay_price) as paidsum"));
                    }
                ]);
                $q->groupBy('game_id')
                    ->selectRaw('sum(pay_price) as sum_price, count(user_id) as user_count, game_id');
            }])
            ->withCount([
                'registers' => function ($q) use ($startDate, $endDate) {
                    if($startDate) {
                        $q->whereDate('created_at', '>=', $startDate);
                    }

                    if($endDate) {
                        $q->whereDate('created_at', '<=', $endDate);
                    }
                },
                'newRegisters' => function ($q) use ($startDate, $endDate) {
                    if($startDate) {
                        $q->whereDate('created_at', '>=', $startDate);
                    }

                    if($endDate) {
                        $q->whereDate('created_at', '<=', $endDate);
                    }
                }]);

        return $query->get();
    }
}