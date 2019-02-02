<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CacheController extends Controller
{
    public function clear_views()
    {
        \Artisan::call('view:clear');
        return redirect()->back()->with('status', 'Views Cleared!');
    }

    public function clear_cache()
    {
        \Artisan::call('cache:clear');
        return redirect()->back()->with('status', 'Cache Cleared!');
    }
}
