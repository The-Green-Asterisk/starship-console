<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Division;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'divisions' => Division::all(),
            'character' => Character::where('user_id', auth()->user()->id)->where('is_active', true)->first(),
        ];

        return view('dashboard')->with($data);
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
