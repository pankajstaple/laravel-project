<?php

namespace App\Providers;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use DB;
use Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Validator::extend(
          'recaptcha',
          'App\\Validators\\ReCaptcha@validate'
        );
 
        $currentUrl = url('/');
        if($currentUrl == "http://slim.getdadstrong.com"){

        }else{
         if(env('REDIRECT_HTTPS'))
         {
           $url->forceScheme('https');
         }
        }
        Schema::defaultStringLength(191);
 
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
        $settings = DB::table('general_settings')->first();
        View::share(compact('settings'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
