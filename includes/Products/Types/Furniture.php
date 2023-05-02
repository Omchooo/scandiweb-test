<?php

namespace Products\Types;

use Products\Product;

class Furniture extends Product
{
    public function __construct($sku, $name, $price, $attribute, $measurement, $height, $width, $length) 
    {
        parent::__construct();

        $this->sku = htmlspecialchars($sku);
        $this->name = htmlspecialchars($name);
        $this->price = htmlspecialchars($price);
        $this->attribute = htmlspecialchars($attribute);
        $this->measurement = htmlspecialchars($measurement);
        $this->size = $this->validateSize(
            [
                'width' => htmlspecialchars($width),
                'height' => htmlspecialchars($height),
                'length' => htmlspecialchars($length)
            ]
        );
    }

    public function validateSize(array $params)
    {
        if ($this->isEmpty($params)) {
            return false;
        }

        if (is_numeric($params['height']) && is_numeric($params['width']) && is_numeric($params['length'])) {
            return $params['height'] . 'x' . $params['width'] . 'x' . $params['length'];
        } else {
            $this->errorInfo = $this->errorInfo(1);

            return false;
        }
    }
}
