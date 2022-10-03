<?php

namespace App\Observers;

class CustomerObserver
{

    public function creating($model)
    {
        user.name = `${user.first_name}, ${user.last_name}`;
    }
}
