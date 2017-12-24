<?php

namespace App\Providers;

use App\Http\Controllers\Frontend\TestController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        view()->share('shareData','共享数据');

        view()->composer('frontend.test1',function($view){
            $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->when(TestController::class)->needs('$int')->give(333);

    }
}
