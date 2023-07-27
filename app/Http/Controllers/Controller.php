<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadImage($image){
        $destinationPath = 'images';
        $fileName = time() . '.' . $image->extension();
        $image->move(public_path($destinationPath), $fileName);
        return $fileName;
    }
}
