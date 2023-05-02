<?php

namespace Database;

use Database\DB;

class QueryBuilder extends DB
{
    private $sql;
    private $params;
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        if (empty($this->params)) {
            try {

                $query = $this->connection->query($this->sql);

                $this->sql = '';

                return $query->fetchAll(\PDO::FETCH_OBJ);
            } catch (\PDOException $e) {

                $errorInfo = $e->getMessage();
                return ['success' => false, 'message' => $errorInfo];
            }
        } else {

            try {

                $stmt = $this->connection->prepare($this->sql);
                $stmt->execute($this->params);

                $this->sql = '';
                $this->params = null;


                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            } catch (\PDOException $e) {

                $errorInfo = $e->getMessage();

                header('Content-Type: application/json', true, 400);
                $this->data = ['success' => false, 'message' => $errorInfo];
            }
        }
    }

    public function execute()
    {
        try {
            $stmt = $this->connection->prepare($this->sql);
            $stmt->execute($this->params);

            $this->sql = '';
            $this->params = null;

            header('Content-Type: application/json', true, 200);
            $this->data = ['success' => true, 'message' => 'successfully executed'];
        } catch (\PDOException $e) {

            $errorInfo = $e->getMessage();

            header('Content-Type: application/json', true, 400);
            $this->data = ['success' => false, 'message' => $errorInfo];
        }

        echo json_encode($this->data);
    }

    public function select(string $select, string $table)
    {

        $this->sql = "SELECT $select FROM $table";

        return $this;
    }

    public function insert(string $table, array $params)
    {

        $this->params = array_values($params);

        $this->sql .= "INSERT INTO $table (SKU, Name, Price, Type, Measurement, Size) VALUES (?, ?, ?, ?, ?, ?)";

        return $this;
    }

    public function delete(string $table)
    {

        $this->sql = "DELETE FROM $table";

        return $this;
    }

    public function where(string $column, string $operator, string $value)
    {

        $this->params[] = $value;

        $this->sql .= " WHERE $column $operator ?";

        return $this;
    }

    public function whereIn(string $column, array $value)
    {

        $this->params = $value;

        $placeholders = implode(',', array_fill(0, count($value), '?'));
        $this->sql .= " WHERE $column IN ($placeholders)";

        return $this;
    }

    public function orderBy(string $column, string $path = 'desc')
    {

        $this->sql .= " ORDER BY $column $path";

        return $this;
    }
}
