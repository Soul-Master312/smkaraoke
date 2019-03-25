<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
const DEFAULT_URL = 'https://karaoke-soulmaster.firebaseio.com/';
const DEFAULT_TOKEN = 'I5n6T07ltNYZlBXdGvHc5r1jUEyQxRt7OHmg8wdr';
const DEFAULT_PATH = '/';
class KaraokeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
//        if (!empty(request()->all())){
//            $key = request()->all()['key'];
//            $client = new \GuzzleHttp\Client();
//            try {
//                $response = $client->request('GET', 'https://www.googleapis.com/youtube/v3/search?type=video&maxResults=20&part=snippet&q='. $key .'&key=AIzaSyDhyTQHtLM94x1iDNcB8KUh6KKh7gL54pI');
//            }catch (\Exception $e){
//                dd($e);
//            }
//            dd($response->getBody());
//            $data = (array) json_decode($response->getBody()->getContents());
//            return response()->json($data);
//        }
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty(request()->all())){
//            dd(request()->all());
            $data = request()->all();
            $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
//            $dateTime = new \DateTime();
//        $firebase->delete(DEFAULT_PATH . '/2017-08-08T08:22:09 00:00');
            $key = $data['key'];
//            array_splice($data, 1, 1);
            unset($data['key']);
            $firebase->set(DEFAULT_PATH . '/list-songs/' . $key, $data);
//
//// --- storing a string ---
//        $firebase->set(DEFAULT_PATH . '/name/contact001', "John Doe");

//// --- reading the stored string ---
//        $name = $firebase->get(DEFAULT_PATH . '/name/contact001');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty(request()->all())){
//            dd(request()->all());
            $data = request()->all();
            $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
            $firebase->delete(DEFAULT_PATH . '/list-songs/' . $data['key']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
