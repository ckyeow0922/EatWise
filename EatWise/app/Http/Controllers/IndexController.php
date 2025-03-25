<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function userIndex()
    {
        $getUsers = new UserController();
        $user = $getUsers->getUser();
        return view('user.index', ['user' => $user]);
    }

    public function index()
    {

        return view('index');
    }
}
