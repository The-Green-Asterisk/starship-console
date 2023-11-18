<?php

namespace App\Http\Controllers;

use App\Events\HpUpdate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        //
    }

    public function index(): View
    {
        return view('index');
    }

    public function broadcast()
    {
        event(new HpUpdate($this->data));
    }
}
