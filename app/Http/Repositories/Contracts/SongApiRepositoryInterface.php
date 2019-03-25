<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/19/2019
 * Time: 5:16 PM
 */

namespace App\Http\Repositories\Contracts;

interface SongApiRepositoryInterface
{
    public function create($data);
    public function delete($node);
    public function addFirst($data);
    public function addPlaying($data);
}