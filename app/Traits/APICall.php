<?php

namespace App\Traits;

use Ixudra\Curl\Facades\Curl;

trait APICall {

public static function callAPI($method, $url, $data=array(),$files=array()){
    
    $url=env('APP_URL').$url;
    $data = json_decode($data,true);

    if($method == 'GET'){

        return $response = Curl::to($url)
        ->get();

    }elseif($method == 'PUT'){

        return $response = Curl::to($url)

        ->withData(['title'=>'Test', 'body'=>'body goes here', 'userId'=>1])

        ->put();

    }elseif($method == 'DELETE'){

        return $response = Curl::to($url)

            ->delete();
    }elseif($method == 'patch'){

        return $response = Curl::to($url)

            ->withData(['title'=>'Test', 'body'=>'body goes here', 'userId'=>1])

            ->patch();
    }elseif($method == 'POST'){
       return $response = Curl::to($url)
            ->withData($data)
            ->post();
            
    }elseif($method == 'POSTFILE'){
        return $response = Curl::to($url)
            ->withData($data)
            ->withFile($files['file_input'],$files['image_file'], $files['getMimeType'], $files['getClientOriginalName']) 
            ->post();
    }  
    // }elseif($method == 'userTokenpost'){
    //     return $response = Curl::to($url)
    //         ->withData($data)
    //         ->withBearer($user_token)
    //         ->post();
            
    // }elseif($method == 'userTokenget'){
    //     return $response = Curl::to($url)
    //     ->withBearer($user_token)
    //     ->get();
    // }
    
} 
}
