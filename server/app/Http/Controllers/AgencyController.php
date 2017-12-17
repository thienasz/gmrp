<?php

namespace App\Http\Controllers;

use App\Services\AgencyService;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

class AgencyController extends Controller
{
    private $agencyService;

    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
    }

    public function index(){
        return response()->jsonOk($this->agencyService->getAllAgency());
    }

    public function show($agencyID){
        //Check agency exits
        $agency = $this->agencyService->getSingleAgency($agencyID);
        if (!$agency)
            return response()->jsonError("Agency does not exits.");

        return response()->json(["data"=>$agency]);
    }

    public function store(Request $request){
        //Validate
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ]);

        $agency = $this->agencyService->createAgency($request);

        return response()->jsonOk($agency);
    }

    public function update(Request $request,$agencyID){
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
        ]);

        //Check agency exits
        $agency = $this->agencyService->getSingleAgency($agencyID);
        if (!$agency)
            return response()->jsonError("Agency does not exists.");

        $updateAgency = $this->agencyService->updateAgency($request,$agencyID);

        if (!$updateAgency)
            return response()->jsonError(["Failed to update agency."]);

        $agency = $this->agencyService->getSingleAgency($agencyID);

        return response()->jsonOk($agency);
    }

    public function delete($agencyID){
        //Check agency exits
        $agency = $this->agencyService->getSingleAgency($agencyID);
        if (!$agency)
            return response()->jsonError("Agency does not exists.");

        $agencyDeleted = $this->agencyService->deleteAgency($agencyID);

        if (!$agencyDeleted)
            response()->jsonError("Failed to delete agency.");

        return response()->jsonOk("Agency deleted successfully");
    }
}
