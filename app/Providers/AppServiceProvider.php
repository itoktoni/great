<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use msztorc\LaravelEnv\Env;
use Illuminate\Support\Facades\Blade;
use ProtoneMedia\LaravelFormComponents\Components\Form;
use ProtoneMedia\LaravelFormComponents\Components\FormInput;
use ProtoneMedia\LaravelFormComponents\Components\FormSelect;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('env_facades', function () {
            return new Env();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::component('form', Form::class);
        Blade::component('form-input', FormInput::class);
        Blade::component('form-select', FormSelect::class);
    }
}
