<?php

namespace App\Http\ViewComposers;


use App\Models\WebsiteSetting;

class SettingComposer
{
    public function compose($view)
    {
        $view->with('setting', WebsiteSetting::first());
    }
}
