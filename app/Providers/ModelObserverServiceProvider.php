<?php

namespace App\Providers;

use App\Models\Customer;
use App\Observers\CustomerObserver;

class ModelObserverServiceProvider extends EventServiceProvider
{
    public function boot()
    {
        parent::boot();
        Customer::observe(CustomerObserver::class);
    }
}
