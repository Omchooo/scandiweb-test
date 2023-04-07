<?php 
require_once('./includes/Product.php');

class DVD extends Product {

    function __construct($sku, $name, $price, $attribute, $measurement, $size) /*$type, - after $price*/
    {
        parent::__construct();

        $this->sku = htmlspecialchars($sku);
        $this->name = htmlspecialchars($name);
        $this->price = htmlspecialchars($price);
        // $this->type = $type;
        $this->attribute = htmlspecialchars($attribute);
        $this->measurement = htmlspecialchars($measurement);
        $this->size = $this->validateSize(array(
            'size' => $size));

    }

    public function validateSize(array $params)
    {
        if ($this->isEmpty($params)) {
            return false;
        }

        if(is_numeric($params['size']))
        {
            return $params['size'];
        } else {
            $this->errorInfo = $this->errorInfo(1);

            return false;
        }

    }
}