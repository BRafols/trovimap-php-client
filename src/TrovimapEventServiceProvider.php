<?php

namespace Trovimap;

use Laravel\Lumen\Providers\EventServiceProvider;

class TrovimapEventServiceProvider extends EventServiceProvider {
    
    

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */

    public function __construct()
    {
        
    }
    
    protected $listen = [
        
    ];

    protected $subscribe = [
        'Trovimap\Subscribers\EvaluationEventSubscriber'
    ];
}