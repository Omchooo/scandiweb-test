<?php

namespace Products\Types;

use Products\Product;

class Book extends Product
{
    public function __construct($sku, $name, $price, $attribute, $measurement, $weight) /*$type, - after $price*/
    {
        parent::__construct();

        $this->sku = htmlspecialchars($sku);
        $this->name = htmlspecialchars($name);
        $this->price = htmlspecialchars($price);
        // $this->type = $type;
        $this->attribute = htmlspecialchars($attribute);
        $this->measurement = htmlspecialchars($measurement);
        $this->size = $this->validateSize(
            [
                'weight' => $weight
            ]
        );
    }

    public function validateSize(array $params)
    {
        if ($this->isEmpty($params)) {
            return false;
        }

        if (is_numeric($params['weight'])) {
            return $params['weight'];
        } else {
            $this->errorInfo = $this->errorInfo(1);

            return false;
        }
    }
}
