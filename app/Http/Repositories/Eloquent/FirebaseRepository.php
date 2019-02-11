<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/11/2019
 * Time: 12:00 PM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\FirebaseRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

abstract class FirebaseRepository implements FirebaseRepositoryInterface
{
    /**
     * @var Factory
     */
    protected $firebase;

    /**
     * @var ServiceAccount
     */
    private $serviceAccount;

    /**
     * @var
     */
    protected $databaseUrl;

    /**
     * @var
     */
    protected $database;

    /**
     * FirebaseRepository constructor.
     */
    public function __construct()
    {
        $this->setDatabaseUrl();
        $this->setServiceAccount();
        $this->makeFirebase();
    }

    abstract public function databaseUrl();

    private function setDatabaseUrl()
    {
        $this->databaseUrl = $this->databaseUrl();
    }

    private function setDatabase()
    {
        $this->database = $this->firebase->getDatabase();
    }

    private function setServiceAccount()
    {

        $jsonString = file_get_contents($this->getJsonFile());
        $data = json_decode($jsonString, true);
//        dd($data);
//
//        $config = json_decode($this->getJsonFile(), true);
//        dd($config);
        $this->serviceAccount = ServiceAccount::fromJsonFile($this->getJsonFile());
    }

    private function getJsonFile()
    {
        //return File::files(storage_path() . '\\' . config('broadcasting.connections.firebase.json_file_name'));
        $storagePath  = Storage::disk('local')->path(config('broadcasting.connections.firebase.json_file_name'));
        return $storagePath;
    }

    private function makeFirebase()
    {
        $this->firebase = (new Factory())
            ->withServiceAccount($this->serviceAccount)
            ->withDatabaseUri($this->databaseUrl);
        $this->setDatabase();
    }


}