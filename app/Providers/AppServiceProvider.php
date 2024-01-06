<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{

    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! function_exists('convertYouTubeUrl')) {
            function convertYouTubeUrl($url) {
                // Mengganti "watch" menjadi "embed"
                return Str::replaceFirst('watch?v=', 'embed/', $url);
            }
        }
    }
}
