<?php
require_once('./includes/Products/Furniture.php');
require_once('./includes/Products/Book.php');
require_once('./includes/Products/DVD.php');

class AddProduct
{

    public static function create(array $formData)
    {
        $types = array("Furniture", "Book", "DVD");

        $productType = $formData['type'] ?? null;
        if (empty($productType)) {
            throw new Exception('Missing product type');
        }

        if (in_array($productType, $types)) { //checks if user tried to add nonexistent product type

        $reflection = new ReflectionClass($productType);
        $constructor = $reflection->getConstructor();
        $params = $constructor->getParameters();
        $args = [];

        foreach ($params as $param) {
            $paramName = $param->getName();
            if (!isset($formData[$paramName])) {
                throw new Exception('Missing parameter: ' . $paramName);
            }
            $args[] = $formData[$paramName];
        }

        $product = $reflection->newInstanceArgs($args);
        $params = $product->getArray();
        

        if ($product->validate($params)) {
            //success - save to database
            $product->insert("listings", $params)->execute();
            
        } else {
            //fail
            $response = array("success" => false, "message" => $product->errorInfo);

            echo json_encode($response);
        }

    } else {
        $data = array("success" => false, "message" => "Please, provide the data of indicated type");

        echo json_encode($data);
    }

    }
}
