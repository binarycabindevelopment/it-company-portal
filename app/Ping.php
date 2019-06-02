<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    protected $fillable = [
        'pingable_id',
        'pingable_type',
        'url',
        'status_code',
        'response_content',
    ];

    public function fetch(){
        $client = new \GuzzleHttp\Client();
        try {
            $request = $client->request('GET', $this->url);
            $this->update([
                'status_code' => $request->getStatusCode(),
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $exception){
            $this->update([
                'status_code' => 406,
            ]);
        } catch (\GuzzleHttp\Exception\ConnectException $exception){
            $this->update([
                'status_code' => 406,
            ]);
        }
    }
}
