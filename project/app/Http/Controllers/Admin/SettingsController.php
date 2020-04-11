<?php

namespace App\Http\Controllers\Admin;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard.index');
    }
}
