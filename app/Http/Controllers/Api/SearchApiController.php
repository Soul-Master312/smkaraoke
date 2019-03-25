<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 1/22/2019
 * Time: 2:56 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Repositories\Contracts\SearchApiRepositoryInterface;
use App\Http\Requests\SearchRequest;

class SearchApiController extends BaseApiController
{
    protected $searchApiRepository;

    /**
     * SearchApiController constructor.
     * @param $searchApiRepository
     */
    public function __construct(SearchApiRepositoryInterface $searchApiRepository)
    {
        $this->searchApiRepository = $searchApiRepository;
    }

    public function searchByName(SearchRequest $request)
    {
        return $this->response($this->searchApiRepository->searchByName($request->input('key_word')));
    }
}