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

    public function showCSKH() {
        return view('settings.cskh');
    }

    public function saveCSKH(Request $req) {
        auth()->user()->cskh_url = $req->cskh_url;
        auth()->user()->save();
        return back();
    }

    public function showSettingMyteam() {
        $setting = DB::table('settings')->first();
        return view('settings.myteam')->with('setting', $setting);
    }

    public function saveSettingMyteam(Request $req) {
        DB::table('settings')->update([
            'teampage' => $req->teampage
        ]);
        return back()->with('success', true);
    }

    public function showSettingVip() {
        $setting = DB::table('settings')->first();
        return view('settings.vip')->with('setting', $setting);
    }

    public function saveSettingVip(Request $req) {
        DB::table('settings')->update([
            'vippage' => $req->vippage
        ]);
        return back()->with('success', true);
    }

    public function showSettingIntroduce() {
        $setting = DB::table('settings')->first();
        return view('settings.introduce')->with('setting', $setting);
    }

    public function saveSettingIntroduce(Request $req) {
        DB::table('settings')->update([
            'introducepage' => $req->introducepage
        ]);
        return back()->with('success', true);
    }

    public function showSettingDownload() {
        $setting = DB::table('settings')->first();
        return view('settings.download')->with('setting', $setting);
    }

    public function saveSettingDownload(Request $req) {
        DB::table('settings')->update([
            'downloadpage' => $req->downloadpage
        ]);
        return back()->with('success', true);
    }
}
