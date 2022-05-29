<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Events\HpUpdate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        // $this->data = $this->getAllHps();
    }

    public function index()
    {
        return view('index')->with($this->data);
    }

    public function broadcast()
    {
        event(new HpUpdate($this->data));
    }
}
