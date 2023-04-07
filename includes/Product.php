<?php
require_once('./includes/QueryBuilder.php');
require_once('./includes/Validation.php');

abstract class Product extends QueryBuilder
{

    use Validate;

    protected $sku,
        $name,
        $price,
        // $type,
        $attribute,
        $measurement,
        $size;

    abstract public function validateSize(array $params);

    public function validate(array $params)
    { 

        if ($this->errorInfo) {
            return false;
        }

        if ($this->isEmpty($params)) {
            return false;
        }

        if ($this->validateSku($params['sku'])) {
            // echo "fail sku";
            $this->errorInfo = $this->errorInfo(2);

            return false;
        } 

        if ($this->validatePrice($params['price'])) {
            // echo "fail price";

            $this->errorInfo = $this->errorInfo(1);

            return false;
        }
        
        return true;
    }

    public function getArray()
    {
        return array(
            "sku" => $this->sku ?? null,
            "name" => $this->name ?? null,
            "price" => $this->price ?? null,
            // "type" => $this->type ?? null,
            "attribute" => $this->attribute ?? null,
            "measurement" => $this->measurement ?? null,
            "size" => $this->size ?? null,
        );
    }

}
