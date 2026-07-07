<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PpdbController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'ppdb')->get()->pluck('value', 'key');
        return view('school.ppdb', compact('settings'));
    }
}
