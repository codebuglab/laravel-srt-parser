<?php

namespace CodeBugLab\SrtParser;

use Illuminate\Support\ServiceProvider;

class SrtParserServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('SrtParser', SrtParser::class);
    }
}
