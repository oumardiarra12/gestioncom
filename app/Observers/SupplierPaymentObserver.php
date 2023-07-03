<?php

namespace App\Observers;

use App\Models\SupplierPayment;

class SupplierPaymentObserver
{
    /**
     * Handle the SupplierPayment "created" event.
     */
    public function created(SupplierPayment $supplierPayment): void
    {
        $supplierPayment->num_supplier_payment='#PS'.str_pad($supplierPayment->id, 8, "0", STR_PAD_LEFT);
        $supplierPayment->save();
    }

    /**
     * Handle the SupplierPayment "updated" event.
     */
    public function updated(SupplierPayment $supplierPayment): void
    {
        //
    }

    /**
     * Handle the SupplierPayment "deleted" event.
     */
    public function deleted(SupplierPayment $supplierPayment): void
    {
        //
    }

    /**
     * Handle the SupplierPayment "restored" event.
     */
    public function restored(SupplierPayment $supplierPayment): void
    {
        //
    }

    /**
     * Handle the SupplierPayment "force deleted" event.
     */
    public function forceDeleted(SupplierPayment $supplierPayment): void
    {
        //
    }
}
