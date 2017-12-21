<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyService extends Service{
    private $agencyModel;

    public function __construct(Agency $agencyModel)
    {
        $this->agencyModel = $agencyModel;
    }

    public function getAllAgency($perPage = 15){
        return $this->agencyModel->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getSingleAgency($postID){
        return $this->agencyModel->find($postID);
    }

    public function deleteAgency($postID){
        return $this->agencyModel->delete($postID);
    }

    public function createAgency(Request $request){
        $data = $request->only(['name', 'description', 'percent_share']);
        return $this->agencyModel->create($data);
    }

    public function updateAgency(Request $request, $postID){
        $data = $request;
        return $this->agencyModel->update($data, $postID);
    }
}