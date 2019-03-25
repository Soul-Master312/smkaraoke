<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/19/2019
 * Time: 1:53 PM
 */

namespace App\Http\Repositories\Contracts;


interface SearchApiRepositoryInterface
{
    public function searchByName($keyWord);
}