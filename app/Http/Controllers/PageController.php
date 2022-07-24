<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function homepage() {
        $setting = DB::table('settings')->first();
        $homepage_images = json_decode($setting->homepage_images);
        $cskh_url = null;
        if (auth()->user()->parent) {
            $cskh_url = auth()->user()->parent()->cskh_url;
        } else {
            $cskh_url = auth()->user()->cskh_url;
        }
        return view('pages.homepage')->with([
            'homepage_images' => $homepage_images,
            'cskh_url' => $cskh_url
        ]);;
    }
}
