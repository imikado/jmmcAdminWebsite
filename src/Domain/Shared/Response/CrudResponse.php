<?php

namespace My\Domain\Shared\Response;

use Exception;

class CrudResponse
{
    protected $item = null;
    protected $errorList = [];
    protected $status = null;

    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';


    public function setItem($item)
    {
        $this->item = $item;
    }
    public function getItem()
    {
        return $this->item;
    }
    public function setErrorList($errorList)
    {
        $this->errorList = $errorList;
    }
    public function getErrorList()
    {
        return $this->errorList;
    }

    public function setStatusSuccess()
    {
        $this->status = self::STATUS_SUCCESS;
    }
    public function isStatusSuccess()
    {
        return ($this->status === self::STATUS_SUCCESS);
    }
}
