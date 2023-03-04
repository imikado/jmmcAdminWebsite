<?php

namespace My\Domain\Shared\Tools;

use Exception;

class Validator
{
    protected $dataList = [];
    protected $errorList = [];
    protected $valid = true;

    public function __construct(object $item)
    {
        $this->dataList = (array)$item;
    }

    protected function getValue(string $field)
    {
        if (!isset($this->dataList[$field])) {
            throw new Exception('Cannot find field ' . $field . ' in dataList to validate');
        }
        return $this->dataList[$field];
    }

    protected function addError($errorMessage)
    {
        $this->errorList[] = $errorMessage;
        $this->valid = false;
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function getErrorList()
    {
        return $this->errorList;
    }

    public function isNotEmpty($field, $errorMessage)
    {
        $value = $this->getValue($field);
        if (trim($value) == '') {
            $this->addError($errorMessage);
        }
    }
}
