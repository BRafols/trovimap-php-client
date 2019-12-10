<?php

namespace Trovimap\Exception;

use Exception;

class CadastralReferenceNotFoundException extends BaseException {

    private $status;

    public function __construct($message="La referencia cadastral no es válida", $code=0 , Exception $previous=NULL, $field = NULL)
    {
        $this->status = 404;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus() {
        return $this->status;
    }

}