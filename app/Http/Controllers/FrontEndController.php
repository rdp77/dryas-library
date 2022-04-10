<?php

namespace App\Http\Controllers;

use App\Models\Catalog;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.frontend.home');
    }

    public function team()
    {
        return view('pages.frontend.team');
    }

    public function about()
    {
        return view('pages.frontend.about');
    }

    public function catalog()
    {
        $data = Catalog::all();
        return view('pages.frontend.catalog', compact('data'));
    }
}