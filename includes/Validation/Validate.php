<?php

namespace Validation;

trait Validate
{
    public $errorInfo;

    private $errorMessages = [
        0 => 'Please, submit required data',
        1 => 'Please, provide the data of indicated type',
        2 => 'The SKU is invalid or already exists',
    ];


    public function errorInfo(string $errorCode)
    {
        if (array_key_exists($errorCode, $this->errorMessages)) {
            $matchedValue = $this->errorMessages[$errorCode];

            return $matchedValue;
        } else {
            $this->errorInfo = "Provided key ($errorCode) does not match any of errors.";
        }
    }

    public function checkSku(string $sku)
    {
        return $this->select('*', 'listings')->where('Sku', '=', $sku)->get();
    }

    public function isEmpty(array $params)
    {
        foreach ($params as $param) {
            if (empty($param)) {
                $this->errorInfo = $this->errorInfo(0);

                return true;
            }
        }
    }

    public function validateSku(string $sku)
    {
        return !(!preg_match('/\s/', $sku) && !$this->checkSku($sku));
    }

    public function validatePrice($price)
    {
        return !(filter_var($price, FILTER_VALIDATE_FLOAT) && (strlen($price) > 0));
    }
}
