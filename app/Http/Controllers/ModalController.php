<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Starship;
use App\Models\User;
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

    public function deleteCharacter($id)
    {
        if (auth()->user()->characters->count() <= 1) {
            $message = 'You cannot delete your only character.';
            $yesButton = false;
        }else{
            $message = 'Are you sure you want to delete this character? This is Un-Undoable!';
            $yesButton = true;
        }

        return view('modals.delete-character', [
            'character' => $id,
            'message' => $message,
            'yesButton' => $yesButton
        ]);
    }

    public function newStarship()
    {
        return view('modals.new-starship');
    }

    public function editStarship($id)
    {
        $starship = Starship::find($id);

        return view('modals.edit-starship', [
            'starship' => $starship,
        ]);
    }

    public function deleteStarship($id)
    {
        if (auth()->user()->starships->count() <= 1) {
            $message = 'You cannot delete your only starship.';
            $yesButton = false;
        }else{
            $message = 'Are you sure you want to delete this starship? This is Un-Undoable! If you are sure, then please select a new starship where the crew will be transferred to. If an appropriate transfer does not exist, please create a new starship first. By default, your crew will be transferred to:';
            $yesButton = true;
        }

        return view('modals.delete-starship', [
            'starship' => Starship::where('id', $id)->first(),
            'message' => $message,
            'yesButton' => $yesButton
        ]);
    }

    public function crewManifest(Starship $starship)
    {
        return view('modals.crew-manifest', [
            'crew' => Character::where('starship_id', $starship->id)->get(),
            'divisions' => $starship->divisions,
            'captain' => $starship->captain(),
        ]);
    }

    public function addUser($email)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->starships()->attach(auth()->user()->characters->where('is_active')->first()->starship);
            $message = $user->name . ' has been brought aboard the ' . auth()->user()->characters->where('is_active')->first()->starship->name . '!';
        }else{
            $message = 'User could not be found.';
        }

        $data = [
            'message' => $message,
        ];

        return $data;
    }
}
