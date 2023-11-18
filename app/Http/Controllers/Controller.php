<?php

namespace App\Http\Controllers;

use App\Events\HpUpdate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('index');
    }

    public function broadcast()
    {
        event(new HpUpdate($this->data));
    }
}
