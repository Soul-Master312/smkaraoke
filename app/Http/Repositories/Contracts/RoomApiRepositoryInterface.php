<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/6/2019
 * Time: 3:51 PM
 */

namespace App\Http\Repositories\Contracts;

use Illuminate\Http\Request;

interface RoomApiRepositoryInterface extends BaseRepositoryInterface
{
    public function createAndLogin(Request $request) : \stdClass;
}