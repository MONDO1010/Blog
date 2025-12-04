<?php

namespace App\Http\ViewComposer;

use App\Models\Category;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view){
        $view->with('categories',Category::where('is_online',1)->get());
    }
}
?>