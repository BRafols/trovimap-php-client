<?php

namespace Trovimap\Exception;

use Exception;

abstract class BaseException extends Exception {

    private $status;

    public function __construct($message="Dirección no válida", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getStatus() {
        return $this->status;
    }

}