<?php
require_once('./includes/QueryBuilder.php');

class ListProduct extends QueryBuilder
{

    public function getProducts()
    {
        return $this->select("*", "listings")->orderBy("Id")->get();
    }

    public function deleteProducts($selectedIds)
    {
        return $this->delete("listings")->whereIn("Id", $selectedIds)->execute();
    }
}
