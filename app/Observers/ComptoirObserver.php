<?php

namespace App\Observers;

use App\Models\comptoir;

class ComptoirObserver
{
    /**
     * Handle the comptoir "created" event.
     */
    public function created(comptoir $comptoir): void
    {
        $comptoir->num_comptoir='#RECP'.str_pad($comptoir->id, 8, "0", STR_PAD_LEFT);
        $comptoir->save();
    }

    /**
     * Handle the comptoir "updated" event.
     */
    public function updated(comptoir $comptoir): void
    {
        //
    }

    /**
     * Handle the comptoir "deleted" event.
     */
    public function deleted(comptoir $comptoir): void
    {
        //
    }

    /**
     * Handle the comptoir "restored" event.
     */
    public function restored(comptoir $comptoir): void
    {
        //
    }

    /**
     * Handle the comptoir "force deleted" event.
     */
    public function forceDeleted(comptoir $comptoir): void
    {
        //
    }
}
