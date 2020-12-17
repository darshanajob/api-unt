<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
        $file = $request->file('images'); 
        $name = Str::random(10);
        $url =  \Storage::putFileAs('images',$file,$name . '.' . $file->extension());

        return env('APP_URL'). '/' . $url;
    }
}
