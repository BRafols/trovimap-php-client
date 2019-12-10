<?php

namespace Trovimap\Subscribers;

class EvaluationEventSubscriber {
    public function subscribe($events) {
        $events->listen(
            'Trovimap\Events\EvaluationCompleted',
            config('trovimap.events.handlers.Trovimap\Events\EvaluationCompleted')
        );
    }
}