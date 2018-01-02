<?php
/**
 * Created by PhpStorm.
 * User: Nguyễn Lương Bách
 * Date: 9/21/2017
 * Time: 10:50 AM
 */

namespace App\Services;

use App\Models\Agency;
use App\Models\GameAgency;
use Illuminate\Http\Request;

class AgencyService extends Service{
    private $agencyModel;
    /**
     * @var GameAgency
     */
    private $gameAgency;

    public function __construct(
        Agency $agencyModel,
        GameAgency $gameAgency
    )
    {
        $this->agencyModel = $agencyModel;
        $this->gameAgency = $gameAgency;
    }

    public function getAllAgency($perPage = 15){
        return $this->agencyModel->with('games')->orderBy('id', 'desc')->paginate($perPage);
    }

    public function getSingleAgency($postID){
        return $this->agencyModel->find($postID);
    }

    public function deleteAgency($postID){
        return $this->agencyModel->delete($postID);
    }

    public function createAgency(Request $request){
        $data = $request->only(['id', 'name', 'description']);
        $agency = $this->agencyModel->updateOrCreate(
            ['id' => $data['id']],
            $data);
        return $this->gameAgency->syncGame($request['games'], $agency);
    }

    public function updateAgency(Request $request, $postID){
        $data = $request;
        return $this->agencyModel->update($data, $postID);
    }
}