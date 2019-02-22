<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/11/2019
 * Time: 3:37 PM
 */

namespace App\Http\Repositories\Eloquent;


use App\Http\Repositories\Contracts\FirebaseApiRepositoryInterface;

class FirebaseApiRepository extends FirebaseRepository implements FirebaseApiRepositoryInterface
{
    public function databaseUrl()
    {
        return config('broadcasting.connections.firebase.database_url');
    }

    public function showData()
    {
        $reference = $this->database->getReference('');
        $value = $reference->getValue();
        return $value;
    }
}