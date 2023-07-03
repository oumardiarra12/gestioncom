<?php

namespace App\Observers;

use App\Models\Reception;

class ReceptionObserver
{
    /**
     * Handle the Reception "created" event.
     */
    public function created(Reception $reception): void
    {
        $reception->num_reception='#RO'.str_pad($reception->id, 8, "0", STR_PAD_LEFT);
        $reception->save();
    }

    /**
     * Handle the Reception "updated" event.
     */
    public function updated(Reception $reception): void
    {
        //
    }

    /**
     * Handle the Reception "deleted" event.
     */
    public function deleted(Reception $reception): void
    {
        //
    }

    /**
     * Handle the Reception "restored" event.
     */
    public function restored(Reception $reception): void
    {
        //
    }

    /**
     * Handle the Reception "force deleted" event.
     */
    public function forceDeleted(Reception $reception): void
    {
        //
    }
}
