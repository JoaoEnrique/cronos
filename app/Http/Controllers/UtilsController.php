<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function generateRandomCode($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }
}
