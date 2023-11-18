<?php

namespace App\Http\Controllers;

use App\Models\Starship;
use App\Models\User;
use App\Notifications\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            $user->save();

            auth()->login($user);

            if ($request->starship) {
                $user->starships()->attach($request->starship);
                $starship = Starship::find($request->starship);
                $user->notify(new Notify(
                    'You have been brought aboard the '.$starship->name.'! Please visit your dashboard to assign a character to this starship.',
                    '/dashboard',
                    $user->id
                ));
                $starship->dm->notify(new Notify(
                    $user->name.' has joined the '.$starship->name.'!',
                    '/starship/'.$starship->id,
                    $starship->dm_id
                ));
            }

            return redirect('/dashboard');
        }
    }
}
