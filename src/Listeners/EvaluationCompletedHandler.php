<?php

namespace Trovimap\Listeners;

use Trovimap\Events\EvaluationCompleted;

class EvaluationCompletedHandler // implements ShouldQueue
{

    // use InteractsWithQueue;

    protected $user;
    protected $evaluation;

    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EvaluationCompleted  $event
     * @return void
     */
    public function handle(EvaluationCompleted $event)
    {
        $this->evaluation = $event->evaluation;

        // Create property from user

        // Sync property with evaluation
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\EvaluationCompleted  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(EvaluationCompleted $event, $exception)
    {
        
    }
}