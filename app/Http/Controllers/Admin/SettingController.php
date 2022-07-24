<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function showSettingHomepageImage() {
        $setting = DB::table('settings')->first();
        $homepage_images = json_decode($setting->homepage_images);
        return view('settings.homepage-image')->with(['homepage_images' => $homepage_images]);
    }

    public function saveSettingHomepageImage(Request $req) {
        DB::table('settings')->update([
            'homepage_images' => $req->data
        ]);
        return;
    }
}
