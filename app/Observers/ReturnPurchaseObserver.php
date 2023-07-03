<?php

namespace App\Observers;

use App\Models\ReturnPurchase;

class ReturnPurchaseObserver
{
    /**
     * Handle the ReturnPurchase "created" event.
     */
    public function created(ReturnPurchase $returnPurchase): void
    {
        $returnPurchase->num_return_purchase='#RPO'.str_pad($returnPurchase->id, 8, "0", STR_PAD_LEFT);
        $returnPurchase->save();
    }

    /**
     * Handle the ReturnPurchase "updated" event.
     */
    public function updated(ReturnPurchase $returnPurchase): void
    {
        //
    }

    /**
     * Handle the ReturnPurchase "deleted" event.
     */
    public function deleted(ReturnPurchase $returnPurchase): void
    {
        //
    }

    /**
     * Handle the ReturnPurchase "restored" event.
     */
    public function restored(ReturnPurchase $returnPurchase): void
    {
        //
    }

    /**
     * Handle the ReturnPurchase "force deleted" event.
     */
    public function forceDeleted(ReturnPurchase $returnPurchase): void
    {
        //
    }
}
