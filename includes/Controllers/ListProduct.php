<?php

namespace Controllers;

use Database\QueryBuilder;

class ListProduct
{
    public function __construct()
    {
        $this->run();
    }

    public function run()
    {
        $result = $this->fetchResults();

        if (isset($_POST['delete'])) {
            // print_r($this->checkId());

            if ($this->checkId()) {
                //Sku exists and will be deleted
                $this->deleteSelected($_POST['delete']);
            } else {
                //Sku does not exist and will not be deleted
                header('Content-Type: application/json', true, 400);
                echo json_encode(['success' => false, 'message' => 'there is no product with this id']);
            }

            exit();
        }

        return require_once('./public/views/index.view.php');
    }


    public function fetchResults()
    {
        return (new QueryBuilder())->select('*', 'listings')->orderBy('Id')->get();
    }

    public function deleteSelected($selectedIds)
    {
        return (new QueryBuilder())->delete('listings')->whereIn('Id', $selectedIds)->execute();
    }

    public function checkId()
    {
        return (new QueryBuilder())->select('*', 'listings')->whereIn('Id', $_POST['delete'])->get();
    }
}
