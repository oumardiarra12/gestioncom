<?php

namespace App\Observers;

use App\Models\ReturnCustomer;

class ReturnCustomerObserver
{
    /**
     * Handle the ReturnCustomer "created" event.
     */
    public function created(ReturnCustomer $returnCustomer): void
    {
        $returnCustomer->num_return_customer='#RCO'.str_pad($returnCustomer->id, 8, "0", STR_PAD_LEFT);
        $returnCustomer->save();
    }

    /**
     * Handle the ReturnCustomer "updated" event.
     */
    public function updated(ReturnCustomer $returnCustomer): void
    {
        //
    }

    /**
     * Handle the ReturnCustomer "deleted" event.
     */
    public function deleted(ReturnCustomer $returnCustomer): void
    {
        //
    }

    /**
     * Handle the ReturnCustomer "restored" event.
     */
    public function restored(ReturnCustomer $returnCustomer): void
    {
        //
    }

    /**
     * Handle the ReturnCustomer "force deleted" event.
     */
    public function forceDeleted(ReturnCustomer $returnCustomer): void
    {
        //
    }
}
