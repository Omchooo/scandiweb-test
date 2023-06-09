<?php

namespace Products\Types;

use Products\Product;

class DVD extends Product
{
    public function __construct($sku, $name, $price, $attribute, $measurement, $size)
    {
        parent::__construct();

        $this->sku = htmlspecialchars($sku);
        $this->name = htmlspecialchars($name);
        $this->price = htmlspecialchars($price);
        $this->attribute = htmlspecialchars($attribute);
        $this->measurement = htmlspecialchars($measurement);
        $this->size = $this->validateSize(
            [
                'size' => $size
            ]
        );
    }

    public function validateSize(array $params)
    {
        if ($this->isEmpty($params)) {
            return false;
        }

        if (is_numeric($params['size'])) {
            return $params['size'];
        } else {
            $this->errorInfo = $this->errorInfo(1);

            return false;
        }
    }
}
