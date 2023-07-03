<?php

namespace App\Observers;

use App\Models\Purchaseinvoice;

class PurchaseinvoiceObserver
{
    /**
     * Handle the Purchaseinvoice "created" event.
     */
    public function created(Purchaseinvoice $purchaseinvoice): void
    {
        $purchaseinvoice->num_purchase_invoice='#PI'.str_pad($purchaseinvoice->id, 8, "0", STR_PAD_LEFT);
        $purchaseinvoice->save();
    }

    /**
     * Handle the Purchaseinvoice "updated" event.
     */
    public function updated(Purchaseinvoice $purchaseinvoice): void
    {
        //
    }

    /**
     * Handle the Purchaseinvoice "deleted" event.
     */
    public function deleted(Purchaseinvoice $purchaseinvoice): void
    {
        //
    }

    /**
     * Handle the Purchaseinvoice "restored" event.
     */
    public function restored(Purchaseinvoice $purchaseinvoice): void
    {
        //
    }

    /**
     * Handle the Purchaseinvoice "force deleted" event.
     */
    public function forceDeleted(Purchaseinvoice $purchaseinvoice): void
    {
        //
    }
}
