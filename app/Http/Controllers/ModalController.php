<?php

namespace App\Http\Controllers;

use App\Models\Starship;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function login()
    {
        return view('modals.login');
    }

    public function roll($starship)
    {
        return view('modals.dice', ['starship' => $starship]);
    }
}
