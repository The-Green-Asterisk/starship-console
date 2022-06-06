<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Events\HpUpdate;
use App\Models\Character;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        // $this->data = $this->getAllHps();
    }

    public function index()
    {
        // $character = Character::where('user_id', auth()->user()->id)->where('is_active', true)->first();

        return view('index');
    }

    public function broadcast()
    {
        event(new HpUpdate($this->data));
    }
}
