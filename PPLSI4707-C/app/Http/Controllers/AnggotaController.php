<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Show member dashboard with profile info.
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('anggota.dashboard', compact('user'));
    }
}
