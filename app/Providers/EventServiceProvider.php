<?php

namespace App\Providers;

use App\Models\comptoir;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerPayment;
use App\Models\Delivery;
use App\Models\Estimate;
use App\Models\Expense;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseOrder;
use App\Models\Reception;
use App\Models\ReturnCustomer;
use App\Models\ReturnPurchase;
use App\Models\SupplierPayment;
use App\Observers\ComptoirObserver;
use App\Observers\CustomerOrderObserver;
use App\Observers\CustomerPaymentObserver;
use App\Observers\DeliveryObserver;
use App\Observers\EstimateObserver;
use App\Observers\ExpenseObserver;
use App\Observers\PurchaseinvoiceObserver;
use App\Observers\PurchaseOrderObserver;
use App\Observers\ReceptionObserver;
use App\Observers\ReturnCustomerObserver;
use App\Observers\ReturnPurchaseObserver;
use App\Observers\SupplierPaymentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        PurchaseOrder::observe(PurchaseOrderObserver::class);
        Reception::observe(ReceptionObserver::class);
        PurchaseInvoice::observe(PurchaseinvoiceObserver::class);
        SupplierPayment::observe(SupplierPaymentObserver::class);
        ReturnPurchase::observe(ReturnPurchaseObserver::class);
        Expense::observe(ExpenseObserver::class);
        CustomerOrder::observe(CustomerOrderObserver::class);
        Delivery::observe(DeliveryObserver::class);
        CustomerPayment::observe(CustomerPaymentObserver::class);
        ReturnCustomer::observe(ReturnCustomerObserver::class);
        Estimate::observe(EstimateObserver::class);
        comptoir::observe(ComptoirObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
