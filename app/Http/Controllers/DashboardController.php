<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Division;
use App\Models\Starship;
use App\Models\User;
use App\Notifications\Notify;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class DashboardController extends Controller
{
    public function index()
    {
        $ship = Starship::where('dm_id', auth()->user()->id)->first();
        if (auth()->user()->is_dm) return redirect('/dm-dashboard/' . ($ship ? $ship->id : ''));

        $character = Character::where('user_id', auth()->user()->id)->where('is_active', true)->first();
        $divisions = Division::all();
        $starships = auth()->user()->starships;
        $starship = $character->starship ?? null;
        $title = auth()->user()->name . ' Dashboard';

        return view('dashboard', compact(
            'title',
            'character',
            'divisions',
            'starships',
            'starship'));
    }

    public function dmIndex(Starship $starship)
    {
        if (!auth()->user()->is_dm) return redirect('/dashboard');

        $data = [
            'divisions' => Division::all(),
            'characters' => Character::where('starship_id', $starship->id)->get(),
            'starships' => Starship::where('dm_id', auth()->user()->id)->get(),
            'starshipId' => $starship->id,
            'starship' => $starship,
            'title' => auth()->user()->name . ' Dashboard > DM Mode'
        ];

        return view('dm-dashboard')->with($data);
    }

    public function imageUpload(Request $request)
    {
        $request->validate([
            'character-image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('character-image');

        Image::make($image)->fit(300, 300, function ($constraint) {}, 'top')->save($image);

        $img = $image->store('img');

        $character = Character::find(auth()->user()->characters->where('is_active', true)->first()->id);
        $character->update([
            'picture_url' => $img,
        ]);
        $character->save();

        return back()->with('success','Character image successfully uploaded!');
    }
}
