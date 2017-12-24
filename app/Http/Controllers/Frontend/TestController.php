<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use App\Model\Address;
use App\Model\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public $user;
    public $int;
    public $address;

    function __construct(User $user, $int, Address $address)
    {
        $this->user = $user;
        $this->address = $address;
        $this->int = $int;

    }

    function index($id)
    {
        $user = $this->user->find($id);

        request()->flashOnly('name');
        // return redirect('test1');
        //return redirect('test1')->withInput();
        return view('frontend.test', ['user' => $user]);
    }

    function test1()
    {


       /// $user = DB::table('users')->pluck('email', 'name');

       // dump($user);
        $address = $this->address->all()->toArray();
        $address= $this->user->find(1)->address->toArray();
        dump($address);

        $user = $this->address->find(6)->user->toArray();
        dump($user);


        return view('frontend.test1');
//        return response('Hello World', 200)
//            ->header('Content-Type', 'text/plain');
        //\Cookie::queue('test', 'Hello, Laramist', 10);
        // dump(request()->cookie('test'));
        //  dump(request()->old('name'));
    }
}

