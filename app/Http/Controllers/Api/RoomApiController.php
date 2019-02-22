<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/1/2019
 * Time: 4:15 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Repositories\Eloquent\FirebaseApiRepository;
use App\Http\Requests\CreateRoomRequest;

class RoomApiController extends BaseApiController
{

    protected $firebaseApiRepository;

    /**
     * RoomApiController constructor.
     * @param $firebaseApiRepository
     */
    public function __construct(FirebaseApiRepository $firebaseApiRepository)
    {
        $this->firebaseApiRepository = $firebaseApiRepository;
    }


    public function create()
    {
        return $this->response($this->firebaseApiRepository->showData(), 'abc');
    }

}