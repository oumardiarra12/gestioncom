<?php

namespace App\Observers;

use App\Models\PurchaseOrder;

class PurchaseOrderObserver
{
    /**
     * Handle the PurchaseOrder "created" event.
     */
    // public function creating(PurchaseOrder $purchaseOrder)
    // {
    //     $purchaseOrder->num_purchase_order='CMD-ACHAT-'.str_pad($purchaseOrder->id + 1, 8, "0", STR_PAD_LEFT);
    // }
    /**
     * Handle the PurchaseOrder "created" event.
     */
    public function created(PurchaseOrder $purchaseOrder): void
    {
        $purchaseOrder->num_purchase_order='#PO'.str_pad($purchaseOrder->id, 8, "0", STR_PAD_LEFT);
        $purchaseOrder->save();
    }

    /**
     * Handle the PurchaseOrder "updated" event.
     */
    public function updated(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "deleted" event.
     */
    public function deleted(PurchaseOrder $purchaseOrder): void
    {
        // $purchaseOrder->line_purchase_order->delete();
    }

    /**
     * Handle the PurchaseOrder "restored" event.
     */
    public function restored(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "force deleted" event.
     */
    public function forceDeleted(PurchaseOrder $purchaseOrder): void
    {
        //
    }
}
