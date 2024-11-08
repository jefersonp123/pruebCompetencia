<?php

namespace App\Listeners;

use App\Events\CountAutorForLibro;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CountAutorLibro
{
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
     * @param  CountAutorForLibro  $event
     * @return void
     */
    public function handle(CountAutorForLibro $event)
    {
        //
    }
}
