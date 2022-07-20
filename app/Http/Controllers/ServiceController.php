<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
   public function list($value='')
   {
        $data = $this->sendPetition()['data']->branches;
        return view('home', compact('data'));
    } 

    public function sendPetition($value='')
    {
        $url = 'https://sandbox.entregalo.co/api/branches/list';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000); //timeout in seconds

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'token: DeTZn0S2y78PRlppnF0u48jl3viRUxul7dSsWA5WssexQykxq4s128r2jgqwKDO1SnZiQIpqrabHBiMM')
        );

        $response = curl_exec($ch);
        curl_close($ch);
        $arrRequests = explode("\r\n\r\n", $response);
        $body = end($arrRequests);
        $bodynew = json_decode($body);
        $array = (array) $bodynew;
        
        return $array;
    }
}
