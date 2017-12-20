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
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $revenue = $this->reportService->revenue($startDate, $endDate);

        return response()->jsonOk($revenue);
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
