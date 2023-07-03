<?php

namespace App\Observers;

use App\Models\CustomerPayment;

class CustomerPaymentObserver
{
    /**
     * Handle the CustomerPayment "created" event.
     */
    public function created(CustomerPayment $customerPayment): void
    {
        $customerPayment->num_customer_payment='#CS'.str_pad($customerPayment->id, 8, "0", STR_PAD_LEFT);
        $customerPayment->save();
    }

    /**
     * Handle the CustomerPayment "updated" event.
     */
    public function updated(CustomerPayment $customerPayment): void
    {
        //
    }

    /**
     * Handle the CustomerPayment "deleted" event.
     */
    public function deleted(CustomerPayment $customerPayment): void
    {
        //
    }

    /**
     * Handle the CustomerPayment "restored" event.
     */
    public function restored(CustomerPayment $customerPayment): void
    {
        //
    }

    /**
     * Handle the CustomerPayment "force deleted" event.
     */
    public function forceDeleted(CustomerPayment $customerPayment): void
    {
        //
    }
}
