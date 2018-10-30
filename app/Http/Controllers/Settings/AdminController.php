<?php

namespace App\Http\Controllers\Settings;

class AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('settings.admin.index');
    }
}