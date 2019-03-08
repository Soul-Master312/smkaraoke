<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/1/2019
 * Time: 4:15 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Repositories\Contracts\RoomApiRepositoryInterface;
use App\Http\Requests\CreateRoomRequest;

class RoomApiController extends BaseApiController
{
    protected $roomApiRepository;

    /**
     * RoomApiController constructor.
     * @param RoomApiRepositoryInterface $roomApiRepository
     */
    public function __construct(RoomApiRepositoryInterface $roomApiRepository)
    {
        $this->roomApiRepository = $roomApiRepository;
    }


    public function create(CreateRoomRequest $request)
    {
        $response = $this->roomApiRepository->createAndLogin($request);
        return $this->response($response->data, 'Tạo Phòng Thành Công');
    }

}