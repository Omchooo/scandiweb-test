<?php

namespace Controllers;

class AddProduct
{
    //could be refactored to get all product types from database
    private $types = ['Furniture', 'Book', 'DVD'];

    public function __construct()
    {
        $this->run();
    }

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->create($_POST);
            // print_r($_POST);

            exit();
        }

        require_once('./public/views/add_product.view.php');
    }

    public function create(array $formData)
    {
        $productType = $formData['type'] ?? null;
        if (empty($productType) || $productType == 'none') {

            header('Content-Type: application/json', true, 400);
            echo json_encode(['success' => false, 'message' => 'Please, submit required data']);
            exit();
        }

        if (in_array($productType, $this->types)) { //checks if user tried to add nonexistent product type

            $class = PRODUCT_TYPE . $productType;

            $reflection = new \ReflectionClass($class);
            $constructor = $reflection->getConstructor();
            $params = $constructor->getParameters();
            $args = [];

            foreach ($params as $param) {
                $paramName = $param->getName();
                if (!isset($formData[$paramName])) {
                    throw new \Exception('Missing parameter: ' . $paramName);
                }
                $args[] = $formData[$paramName];
            }

            $product = $reflection->newInstanceArgs($args);
            $params = $product->getArray();

            if ($product->validate($params)) {
                //success - save to database
                $product->insert('listings', $params)->execute();
            } else {
                //fail

                header('Content-Type: application/json', true, 400);
                echo json_encode(['success' => false, 'message' => $product->errorInfo]);
            }
        } else {

            header('Content-Type: application/json', true, 400);
            echo json_encode(['success' => false, 'message' => 'Please, provide the data of indicated type']);
            exit();
        }
    }
}
