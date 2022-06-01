<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Starship;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function success(Request $request)
    {
        return view('modals.success', [
            'message' => $request->message,
        ]);
    }

    public function register()
    {
        return view('modals.register');
    }

    public function login()
    {
        return view('modals.login');
    }

    public function roll($starship)
    {
        return view('modals.dice', ['starship' => $starship]);
    }

    public function newCharacter()
    {
        return view('modals.new-character');
    }

    public function editCharacter($id)
    {
        $character = Character::find($id)->load('starship');

        return view('modals.edit-character', [
            'character' => $character,
        ]);
    }

    public function newStarship()
    {
        return view('modals.new-starship');
    }
}
