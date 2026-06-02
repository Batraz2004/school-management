<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function getView(string $viewName, $results)
    {
        return view($viewName, $results);
    }
}
