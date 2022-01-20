<?php

namespace App\Http\Controllers\Frontend;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }
    public function order()
    {
        return view('frontend.order');
    }
    public function visit()
    {
        return view('frontend.visit');
    }
}
