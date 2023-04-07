<?php 
require_once('./includes/Product.php');

class Furniture extends Product {

    function __construct($sku, $name, $price, $attribute, $measurement, $height, $width, $length) /*$type, - after $price*/
    {
        parent::__construct();

        $this->sku = htmlspecialchars($sku);
        $this->name = htmlspecialchars($name);
        $this->price = htmlspecialchars($price);
        // $this->type = $type;
        $this->attribute = htmlspecialchars($attribute);
        $this->measurement = htmlspecialchars($measurement);
        $this->size = $this->validateSize(array(
            'width' => htmlspecialchars($width), 
            'height' => htmlspecialchars($height), 
            'length' =>htmlspecialchars($length))
        );

    }

    public function validateSize(array $params)
    {
        if ($this->isEmpty($params)) {
            return false;
        }

        if(is_numeric($params['height']) && is_numeric($params['width']) && is_numeric($params['length']))
        {
            return $params['height'].'x'.$params['width'].'x'.$params['length'];
        } else {
            $this->errorInfo = $this->errorInfo(1);

            return false;
        }

    }
}