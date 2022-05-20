<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class WeatherController extends Controller
{
    public function index()
    {
        $curl = curl_init();
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

        curl_setopt_array($curl, array(
            CURLOPT_USERAGENT => $agent,
            CURLOPT_URL => config('app.api_endpoint'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $this->updateUserApiUsage(auth()->user());

        $response = json_decode($response, true);
        $json_response['data'] = $this->jsonResource($response['properties']['periods']);
        return response()->json($json_response, 200)
            ->header('Content-Type', 'application/json');
    }

    private function updateUserApiUsage($user)
    {
        $user->usage_count = $user->max('usage_count') + 1;
        $user->last_used_on = Carbon::now();
        $user->save();
    }

    private function jsonResource($requests)
    {
        $json_response = [];
        foreach ($requests as $request) {
            $json_response[] = [
                'name'              => $request['name'],
                'startTime'         => $request['startTime'],
                'endTime'           => $request['endTime'],
                'temperature'       => $request['temperature'],
                'temperatureUnit'   => $request['temperatureUnit'],
                'icon'              => $request['icon'],
                'shortForecast'     => $request['shortForecast']
            ];
        }

        return $json_response;
    }
}
