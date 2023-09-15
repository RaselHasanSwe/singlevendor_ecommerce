<?php

namespace App\Http\ViewComposers;

use App\Models\Category;

class CategoryComposer
{
    public function compose($view)
    {
        $view->with('headerCategories', Category::with('subCategory.innerCategory')->get());
    }
}
