<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorApi extends Controller
{
    function fetchActorsByBirthday(Request $request, $date)
    {
        $API_Key = "";

        if ($date) {
            list($year, $month, $day) = explode('-', $date);

            
            $actors_list = list_born_today($month, $day, $API_Key);

            preg_match_all('/\/name\/([a-z0-9]+)/i', $actors_list, $matches);
            $response_ids = $matches[1];
            $counter = 0;
            $actors_data = array();
            foreach ($response_ids as $id) {
                $counter++;
                $actors_data[] = get_info($id, $API_Key);
                if ($counter == 3) break;
            }
    
            $res = array("actors" => array());

            foreach ($actors_data as $actor) {
                $img_result = $actor['image']['url'];
                $res['actors'][] = array('name' => $actor['name'], 'image' => $img_result);
            }

            return response()->json($res);
        } else {
            return response()->json(['error' => 'Birthday parameter is missing.'], 400);
        }
    }
}



  function list_born_today($month, $day, $API_Key) {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=$month&day=$day",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
                "X-RapidAPI-Key: $API_Key"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
              return $response;
        }
        
    }

    function get_info($id,$API_Key){
        $second_curl = curl_init();
    
                curl_setopt_array($second_curl, [
                    CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/get-bio?nconst=$id",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
                        "X-RapidAPI-Key: $API_Key"
                    ],
                ]);
    
                $second_response = curl_exec($second_curl);
                $second_err = curl_error($second_curl);
    
                curl_close($second_curl);
               
                if ($second_err) {
                    echo "cURL Error #:" . $second_err;
                } else {
                    return json_decode($second_response, true);
                }
    }