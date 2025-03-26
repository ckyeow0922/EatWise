<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DietRecommenderController extends Controller
{
    //
    public function showDietRecommender()
    {
        $userController = new UserController();
        $user = $userController->getUser();
        return view('user.diet_recommender', ['user' => $user]);
    }
}
