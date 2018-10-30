<?php

namespace App\Http\Controllers\Settings;

use App\Models\User\User;
use Illuminate\Http\JsonResponse;

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

    public function getAccountFirstUsers(): JsonResponse {
        // Gets first users created in each account
        $users = User::orderBy('created_at', 'asc')->groupBy('account_id')->with('Account')->get();
        return response()->json($users);
    }
}