<?php

namespace Trovimap\Exception;

use Exception;

class EvaluationException extends BaseException {

    private $status;

    public function __construct($message="Ha habido un problema, vuelva a intentarlo más tarde", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->status = 500;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus() {
        return $this->status;
    }

}