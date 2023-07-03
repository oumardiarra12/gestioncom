<?php

namespace App\Observers;

use App\Models\CustomerOrder;

class CustomerOrderObserver
{
    /**
     * Handle the CustomerOrder "created" event.
     */
    public function created(CustomerOrder $customerOrder): void
    {
        $customerOrder->num_customer_order='#CO'.str_pad($customerOrder->id, 8, "0", STR_PAD_LEFT);
        $customerOrder->save();
    }

    /**
     * Handle the CustomerOrder "updated" event.
     */
    public function updated(CustomerOrder $customerOrder): void
    {
        //
    }

    /**
     * Handle the CustomerOrder "deleted" event.
     */
    public function deleted(CustomerOrder $customerOrder): void
    {
        //
    }

    /**
     * Handle the CustomerOrder "restored" event.
     */
    public function restored(CustomerOrder $customerOrder): void
    {
        //
    }

    /**
     * Handle the CustomerOrder "force deleted" event.
     */
    public function forceDeleted(CustomerOrder $customerOrder): void
    {
        //
    }
}
