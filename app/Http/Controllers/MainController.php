<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Show the resources.
     *

     */
    public function index()
    {
        return view('main_views');
    }
}

?>
