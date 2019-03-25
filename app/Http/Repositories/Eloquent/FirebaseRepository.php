<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/11/2019
 * Time: 12:00 PM
 */

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Contracts\FirebaseRepositoryInterface;
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
     * @var
     */
    protected $node = '';

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
        $config = json_decode($this->getJsonFile(), true);
        $this->serviceAccount = ServiceAccount::fromArray($config);
    }

    private function getJsonFile()
    {
        return Storage::disk('local')->get(config('broadcasting.connections.firebase.json_file_name'));
    }

    private function makeFirebase()
    {
        $this->firebase = (new Factory())
            ->withServiceAccount($this->serviceAccount)
            ->withDatabaseUri($this->databaseUrl)
            ->create();
        $this->setDatabase();
    }

    public function getKey() {
        return $this->database->getReference($this->node)->push()->getKey();
    }

    public function node($node = '')
    {
        $this->node = $node;
        return $this;
    }

    public function get()
    {
        return $this->database->getReference($this->node)->getValue();
    }

    public function create($data)
    {
        return $this->database->getReference($this->node)->set($data);
    }

    public function replace($data)
    {
        $this->database->getReference($this->node)->set($data);
    }

    public function update($data)
    {
        $this->database->getReference($this->node)->update($data);
    }

    public function delete()
    {
        if ($this->node) {
            return $this->database->getReference($this->node)->remove();
        }
    }

}