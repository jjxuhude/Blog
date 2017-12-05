<?php
/**
 * Created by PhpStorm.
 * User: zhou2
 * Date: 2017/12/5
 * Time: 22:45
 */

namespace App\Http\Controllers\Frontend;


class AjaxController extends Controller
{

    function lists () {
        $data=[['name'=>'item01'],['name'=>'item01']];
        return response()->json($data);
    }
}