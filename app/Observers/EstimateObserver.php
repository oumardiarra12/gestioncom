<?php

namespace App\Observers;

use App\Models\Estimate;

class EstimateObserver
{
    /**
     * Handle the Estimate "created" event.
     */
    public function created(Estimate $estimate): void
    {
        $estimate->num_estimates='#ES'.str_pad($estimate->id, 8, "0", STR_PAD_LEFT);
        $estimate->save();
    }

    /**
     * Handle the Estimate "updated" event.
     */
    public function updated(Estimate $estimate): void
    {
        //
    }

    /**
     * Handle the Estimate "deleted" event.
     */
    public function deleted(Estimate $estimate): void
    {
        //
    }

    /**
     * Handle the Estimate "restored" event.
     */
    public function restored(Estimate $estimate): void
    {
        //
    }

    /**
     * Handle the Estimate "force deleted" event.
     */
    public function forceDeleted(Estimate $estimate): void
    {
        //
    }
}
