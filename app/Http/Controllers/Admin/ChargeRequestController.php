<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChargeRequestController extends Controller
{
    public function index()
    {
        return view('charge_requests.index');
    }
}
