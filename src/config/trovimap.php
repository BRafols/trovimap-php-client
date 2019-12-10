<?php

return [
    'events' => [
        'handlers' => [
            'Trovimap\Events\EvaluationCompleted' => 'Trovimap\Listeners\EvaluationCompletedHandler'
        ],
        'test' => 'test'
    ]
];