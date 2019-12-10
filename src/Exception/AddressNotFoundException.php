<?php

namespace Trovimap\Exception;

use Exception;

class AddressNotFoundException extends BaseException {

    private $status;

    public function __construct($message="Dirección no válida", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->status = 422;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus() {
        return $this->status;
    }

}