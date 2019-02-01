<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/1/2019
 * Time: 4:15 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateRoomRequest;
use Illuminate\Support\Facades\App;

class RoomApiController extends BaseController
{

    public function create(CreateRoomRequest $request)
    {
        dd(App::getLocale());
    }

}