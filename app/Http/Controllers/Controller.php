<?php

namespace App\Http\Controllers;

use View;
use App\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        View::composer('front.nav', function($view){
            $categories = Category::lists('title', 'id');
            $view->with(compact('categories'));
            // dd($categories);//vardump
        });
    }
}
