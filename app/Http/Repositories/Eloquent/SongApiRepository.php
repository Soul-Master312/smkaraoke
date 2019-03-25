<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 3/19/2019
 * Time: 5:16 PM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\FirebaseApiRepositoryInterface;
use App\Http\Repositories\Contracts\SongApiRepositoryInterface;

class SongApiRepository implements SongApiRepositoryInterface
{
    protected $firebaseApiRepository;

    /**
     * SongApiRepository constructor.
     * @param $firebaseApiRepository
     */
    public function __construct(FirebaseApiRepositoryInterface $firebaseApiRepository)
    {
        $this->firebaseApiRepository = $firebaseApiRepository;
    }

    public function create($data)
    {
        $node = $this->firebaseApiRepository->getKey();
        $data['node'] = $node;
        return $this->firebaseApiRepository->node($this->getNode($node))->create($data);
    }

    public function delete($node)
    {
        return $this->firebaseApiRepository->node($this->getNode($node))->delete();
    }

    public function addFirst($data)
    {
        return $this->firebaseApiRepository->node($this->getNode())->update($data);
    }

    public function addPlaying($data)
    {
        $this->delete($data['node']);
        return $this->firebaseApiRepository->node('/playing/')->create($data);
    }

    public function getNode($node = '') {
        return '/songs/' . $node;
    }
}