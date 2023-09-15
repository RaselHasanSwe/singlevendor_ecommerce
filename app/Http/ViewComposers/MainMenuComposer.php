<?php

namespace App\Http\ViewComposers;

use App\Models\MainMneu;

class MainMenuComposer
{
    public function compose($view)
    {
        $view->with('main_menu', MainMneu::latest()->get());
    }
}
