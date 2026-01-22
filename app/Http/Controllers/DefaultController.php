<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DefaultController extends Controller
{
    function home() 
    { 
      return view('default.home');
    }
}

?>