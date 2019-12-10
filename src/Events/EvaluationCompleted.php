<?php

namespace Trovimap\Events;

use Illuminate\Queue\SerializesModels;
use Trovimap\Propertista\TrovimapPhpClient\Models\Evaluation;

class EvaluationCompleted {
    
    use SerializesModels;

    public $evaluation;
    public $user;
    public $reference;

    public function __construct($evaluation, $user, $reference = null)
    {
        $this->evaluation = $evaluation;
        $this->user = $user;
        $this->reference = $reference;
    }
}