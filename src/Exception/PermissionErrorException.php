<?php

namespace Trovimap\Exception;

use Exception;

class PermissionErrorException extends BaseException {

    private $status;

    public function __construct($message="No tiene permisos", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->status = 403;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus() {
        return $this->status;
    }

}