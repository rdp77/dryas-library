<?php

namespace App\Http\Controllers;

use App\Models;

class CatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Models();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCatalog()
    {
        $data = $this->model->buku_katalog()->get();
        return view('pages.catalog', compact('data'));
    }
}