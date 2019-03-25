<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/19/2019
 * Time: 5:15 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Repositories\Contracts\SongApiRepositoryInterface;
use Illuminate\Http\Request;

class SongApiController extends BaseApiController
{
    protected $songApiRepository;

    /**
     * SongApiController constructor.
     * @param $songApiRepository
     */
    public function __construct(SongApiRepositoryInterface $songApiRepository)
    {
        $this->songApiRepository = $songApiRepository;
    }

    public function create(Request $request)
    {
        return $this->response($this->songApiRepository->create($request->all()));
    }

    public function delete(Request $request)
    {
        return $this->response($this->songApiRepository->delete($request->input('node')));
    }

    public function addFirst(Request $request)
    {
        return $this->response($this->songApiRepository->addFirst($request->all()));
    }

    public function addPlaying(Request $request)
    {
        return $this->response($this->songApiRepository->addPlaying($request->all()));
    }

}