<?php

namespace Controllers;

use Database\QueryBuilder;

class ProductController
{

    private $types = ['Furniture', 'Book', 'DVD'];

    //list all products
    public function index()
    {
        $result = $this->fetchResults();

        return require_once('./public/views/index.view.php');
    }

    //delete products
    public function delete()
    {
        if (!isset($_POST['id'])) {
            header('Content-Type: application/json', true, 400);
            echo json_encode(['success' => false, 'message' => 'please select a product to delete']);

            exit();
        }

        $ids = $_POST['id'];
        if ($this->checkId($ids)) {
            //Sku exists and will be deleted
            $this->deleteSelected($ids);
        } else {
            //Sku does not exist and will not be deleted
            header('Content-Type: application/json', true, 400);
            echo json_encode(['success' => false, 'message' => 'there is no product with this id']);
        }

        exit();
    }

    //add product
    public function add()
    {
        require_once('./public/views/add_product.view.php');
    }

    public function create()
    {
        $formData = $_POST;

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

    public function fetchResults()
    {
        return (new QueryBuilder())->select('*', 'listings')->orderBy('Id')->get();
    }

    public function deleteSelected($selectedIds)
    {
        return (new QueryBuilder())->delete('listings')->whereIn('Id', $selectedIds)->execute();
    }

    public function checkId($id)
    {
        return (new QueryBuilder())->select('*', 'listings')->whereIn('Id', $id)->get();
    }
}
