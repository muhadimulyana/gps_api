<?php

namespace App\Http\Controllers;

use App\Gps;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class GpsController extends Controller
{
    public function getMarkers()
    {
        $data = Gps::get();

        if($data){
            $out = [
                'message' => 'success',
                'result' => $data,
                'code' => 200,
            ];
        } else {
            $out = [
                'message' => 'empty',
                'result' => [],
                'code' => 200,
            ];
        }

        return response()->json($out, $out['code'], [], JSON_NUMERIC_CHECK);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //'id' => 'required',
            'place' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'user' => 'required'
        ]);

        $place = $request->input('place');
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $user = $request->input('user');
        $id = $lat . '_' . $lng; 

        try {

            $data = [
                'id' => $id,
                'place' => $place,
                'lat' => $lat,
                'lng' => $lng,
                'user' => $user
            ];
            
            $insert = Gps::insertOrIgnore($data);

            $out = [
                'message' => 'Marker Saved!',
                'code' => 201,
            ];

        } catch ( QueryException $e) {
            $out = [
                'message' =>  'Error: [' . $e->errorInfo[1] . '] ' . $e->errorInfo[2],
                'status' => false,
                'result' => [],
                'code' => 500
            ];
        }

        return response()->json($out, $out['code'], [], JSON_NUMERIC_CHECK);

    }
}