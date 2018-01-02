<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class ReportController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function revenue(Request $request){
        $revenue = (object)[
            "pu" =>  random_int(1,100),
            "nru" => random_int(1,100),
            "revenue" => random_int(3000,5000),
            "reTelco" => random_int(2,3000),
            "arpu" => random_int(1,100),
            "arppu" => random_int(1,100)
        ];

        return response()->jsonOk($revenue);
    }

    public function revenueYear(Request $request) {
        $res = [];

        for ($i = 1; $i <13; $i++) {
            $re = random_int(3000,5000);
            $ret = $re * random_int(40, 100)/100;

            array_push(
                $res, (object)[
                    "month" => $i,
                    "pu" => random_int(1,100),
                    "revenue" => $re,
                    "reTelco" => $ret
                ]
            );
        }

        return response()->jsonOk($res);
    }


    public function revenueAgency(Request $request){
        $revenue = (object)[
            "pu" =>  random_int(1,100),
            "nru" => random_int(1,100),
            "revenue" => random_int(3000,5000),
            "reTelco" => random_int(2,3000),
            "arpu" => random_int(1,100),
            "arppu" => random_int(1,100)
        ];

        return response()->jsonOk($revenue);
    }

    public function revenueAgencyYear(Request $request) {
        $res = [];

        for ($i = 1; $i <13; $i++) {
            $re = random_int(3000,5000);
            $rea = $re * random_int(40, 100)/100;
            $rec = $re - $rea;

            array_push(
                $res, (object)[
                "month" => $i,
                "pu" => random_int(1,100),
                "setup" => random_int(1,100),
                "revenue" => $re,
                "reAgency" => $rea,
                "reCompany" => $rec,
                "nru" => random_int(1,100),
            ]
            );
        }

        return response()->jsonOk($res);
    }

    public function registerUser(Request $request){
        $data = (object)[
            "ru" => "100"
        ];

        return response()->jsonOk($data);
    }

    public function activeUser(Request $request){
        $data = (object)[
            "au" => "100"
        ];

        return response()->jsonOk($data);
    }

    public function currentActiveUser(Request $request){
        $data = (object)[
            "ccu" => "100"
        ];

        return response()->jsonOk($data);
    }

    public function paidUser(Request $request){
        $data = (object)[
            "pu" => "100"
        ];

        return response()->jsonOk($data);
    }

    public function userReport(Request $request){
        $data = (object)[
            "ru" => "100",
            "au" => "100",
            "ccu" => "100",
            "pu" => "100",
        ];

        return response()->jsonOk($data);
    }

    public function paymentCard(Request $request){
        $data = [
            (object)[
                "name" => "Viettel",
                "total_price" => "100"
            ],
            (object)[
                "name" => "Vina",
                "total_price" => "100"
            ],
            (object)[
                "name" => "Mobi",
                "total_price" => "100"
            ],
        ];

        return response()->jsonOk($data);
    }

    public function totalInstall(Request $request){
        $data = (object)[
            "install" => "200",
        ];

        return response()->jsonOk($data);
    }

    public function totalRevenue(Request $request){
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $revenue = $this->reportService->totalRevenue($startDate, $endDate);

        return response()->jsonOk($revenue);
    }

    public function accountReport(Request $request) {
        $game = $request->game_id;
        $month = $request->month;
        $year = $request->year;
        $activeTime = $request->active_time;

        $accReport = $this->reportService->accountReport($game, $month, $year, $activeTime);

        return response()->jsonOk($accReport);
    }

    public function cardRevenue(Request $request){
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $revenue = $this->reportService->cardRevenue($startDate, $endDate);

        return response()->jsonOk($revenue);
    }


    public function agencyRevenue(Request $request){
        $startDate = $request->start_date ;
        $endDate = $request->end_date;
        $agency_id = $request->agency_id;

        $revenue = $this->reportService->agencyRevenue($startDate, $endDate, $agency_id);

        return response()->jsonOk($revenue);
    }
}
