<?php
/**
 * Created by PhpStorm.
 * User: zhou2
 * Date: 2017/11/21
 * Time: 23:29
 */

namespace App\Http\Controllers\Backend;


class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}