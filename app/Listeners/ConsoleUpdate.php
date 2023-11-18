<?php

namespace App\Listeners;

use App\Events\HpUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ConsoleUpdate implements ShouldQueue
{
    use InteractsWithQueue;

    public $afterCommit = true;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(HpUpdate $event)
    {
        $data = $event->data;
        $this->data = $data;
    }
}
