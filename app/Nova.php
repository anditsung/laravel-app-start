<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Nova
{
    public static function jsonVariables(Request $request)
    {
        return [
            'appName' => config('app.name', 'Laravel'),
            'locale' => config('app.locale', 'en'),
            'openRegistration' => config('app.openRegistration', true),
            'navigationMenus' => static::navigationMenus(),
            'brandColors' => static::brandColors(),
            'brandColorsCSS' => static::brandColorsCSS(),
            'translations' => static::translations(),
        ];
    }

    public static function translations()
    {
        $languages = ['en'];
        if (app()->getLocale() != 'en') {
            $languages[] = app()->getLocale();
        }
        foreach ($languages as $lang) {
            $file = lang_path($lang.'.json');
            if (is_readable($file)) {
                $translations[$lang] = json_decode(file_get_contents($file), true);
            }
        }
        return $translations;
    }

    public static function navigationMenus()
    {
        return [
//            "role",
//            "permission",
//            "user",
//            "invite",
        ];
    }

    public static function colors()
    {   $colors = [];
        // tailwind default color node_modules/tailwindcss/types/generated/colors.d.ts
        // https://www.rapidtables.com/convert/color/hex-to-rgb.html
        $color = config('app.colors');
        if ($color == 'emerald') {
            $colors = [
                "50" => "236, 253, 245", //"#ecfdf5",
                "100" => "209, 250, 229", //"#d1fae5",
                "200" => "167, 243, 208", //"#a7f3d0",
                "300" => "110, 231, 183", //"#6ee7b7",
                "400" => "52, 211, 153", //"#34d399",
                "500" => "16, 185, 129", //"#10b981",
                "600" => "5, 150, 105", //"#059669",
                "700" => "4, 120, 87", //"#047857",
                "800" => "6, 95, 70", //"#065f46",
                "900" => "6, 78, 59", //"#064e3b",
            ];
        }
        else if ($color == 'indigo') {
            $colors = [
                '50' => '238, 242, 255', //#eef2ff',
                '100' => '224, 231, 255', //#e0e7ff',
                '200' => '199, 210, 254', //'#c7d2fe',
                '300' => '165, 180, 252', //'#a5b4fc',
                '400' => '129, 140, 248', //'#818cf8',
                '500' => '99, 102, 241', //'#6366f1',
                '600' => '79, 70, 229', //'#4f46e5',
                '700' => '67, 56, 202', //'#4338ca',
                '800' => '55, 48, 163', //'#3730a3',
                '900' => '49, 46, 129', //'#312e81',
            ];
        }
        else if ($color == 'teal') {
            $colors = [
                '50' => '240, 253, 250', //'#f0fdfa',
                '100' => '204, 251, 241', //'#ccfbf1',
                '200' => '153, 246, 228', //'#99f6e4',
                '300' => '94, 234, 212', //'#5eead4',
                '400' => '45, 212, 191', //'#2dd4bf',
                '500' => '20, 184, 166', //'#14b8a6',
                '600' => '13, 148, 136', //'#0d9488',
                '700' => '15, 118, 110', //'#0f766e',
                '800' => '17, 94, 89', //'#115e59',
                '900' => '19, 78, 74', //'#134e4a',
            ];
        }
        return $colors;
    }

    /**
     * Return Nova's custom brand colors.
     *
     * @return array
     */
    public static function brandColors()
    {
        //$colors = config('app.brand.colors');
        $colors = static::colors();

        return collect($colors)->reject(function ($value, $key) {
            return is_null($value);
        })->all();
    }

    /**
     * Return the CSS used to override Nova's brand colors.
     *
     * @return string
     */
    public static function brandColorsCSS()
    {
        return Blade::render('
:root {
@foreach($colors as $key => $value)
    --colors-primary-{{ $key }}: {{ $value }};
@endforeach
}', [
            'colors' => static::brandColors(),
        ]);
    }
}
