<?php
/**
 * Created by PhpStorm.
 * User: zhou2
 * Date: 2017/11/22
 * Time: 22:22
 */

namespace App\Http\Controllers\Backend;


class HomeController extends Controller
{
    function index(){
        return view('backend.home.index');
    }
}