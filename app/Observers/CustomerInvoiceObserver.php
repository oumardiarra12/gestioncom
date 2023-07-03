<?php

namespace App\Observers;

use App\Models\CustomerInvoice;

class CustomerInvoiceObserver
{
    /**
     * Handle the CustomerInvoice "created" event.
     */
    public function created(CustomerInvoice $customerInvoice): void
    {
        $customerInvoice->num_customer_invoices='#CI'.str_pad($customerInvoice->id, 8, "0", STR_PAD_LEFT);
        $customerInvoice->save();
    }

    /**
     * Handle the CustomerInvoice "updated" event.
     */
    public function updated(CustomerInvoice $customerInvoice): void
    {
        //
    }

    /**
     * Handle the CustomerInvoice "deleted" event.
     */
    public function deleted(CustomerInvoice $customerInvoice): void
    {
        //
    }

    /**
     * Handle the CustomerInvoice "restored" event.
     */
    public function restored(CustomerInvoice $customerInvoice): void
    {
        //
    }

    /**
     * Handle the CustomerInvoice "force deleted" event.
     */
    public function forceDeleted(CustomerInvoice $customerInvoice): void
    {
        //
    }
}
