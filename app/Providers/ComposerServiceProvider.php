<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\MainMenuComposer;
use App\Http\ViewComposers\SettingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'frontend.layout.header',
                'frontend.layout.footer',
            ],
            CategoryComposer::class
        );

        View::composer(
            [
                'frontend.layout.header',
                'frontend.layout.footer',
                'frontend.contact-us.index'
            ],
            SettingComposer::class
        );

        View::composer(
            [
                'frontend.layout.header'
            ],
            MainMenuComposer::class
        );
    }
}
