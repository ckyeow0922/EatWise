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
        $userName = $getUsers->getUserName();
        return view('user.index', ['userName' => $userName]);
    }

    public function index()
    {

        return view('index');
    }
}
