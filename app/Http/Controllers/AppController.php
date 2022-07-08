<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AppController extends Controller
{
    public function home()
    {
        $appName = str_replace(' ', '', config('app.name'));

        $pageFile = resource_path('js/Pages/Web/') . $appName . '.vue';

        if (! file_exists($pageFile)) {
            $appName = "Home";
        }

        return Inertia::render('Web.' . $appName);
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }
}
