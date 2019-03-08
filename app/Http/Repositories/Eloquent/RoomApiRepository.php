<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/6/2019
 * Time: 3:50 PM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\AuthApiRepositoryInterface;
use App\Http\Repositories\Contracts\FirebaseApiRepositoryInterface;
use App\Http\Repositories\Contracts\RoomApiRepositoryInterface;
use App\Models\Room;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomApiRepository extends BaseRepository implements RoomApiRepositoryInterface
{
    use ResponseTrait;

    protected $firebaseApiRepository;
    protected $authApiRepository;

    /**
     * RoomApiRepository constructor.
     * @param FirebaseApiRepositoryInterface $firebaseApiRepository
     * @param AuthApiRepositoryInterface $authApiRepository
     * @throws \App\Http\Repositories\Exceptions\RepositoryException
     */
    public function __construct(FirebaseApiRepositoryInterface $firebaseApiRepository, AuthApiRepositoryInterface $authApiRepository)
    {
        parent::__construct();
        $this->firebaseApiRepository = $firebaseApiRepository;
        $this->authApiRepository = $authApiRepository;
    }


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Room::class;
    }

    public function createAndLogin(Request $request) : \stdClass
    {
        $request->merge([
            'identifier' => $this->firebaseApiRepository->getKey('room'),
            'password' => Hash::make($request->password)
        ]);
        $room = $this->create($request->except('password_confirmation'));
        $token = $room->createToken($room->identifier);
        return $this->_setData(['token' => $token->accessToken, 'user' => $room])->_response();
    }
}