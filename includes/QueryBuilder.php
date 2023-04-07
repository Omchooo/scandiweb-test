<?php
require_once('./includes/database.php');
abstract class QueryBuilder extends DB
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

                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {

                $errorInfo = $e->getMessage();
                return array("success" => false, "message" => $errorInfo);
            }
        } else {

            try {

                $stmt = $this->connection->prepare($this->sql);
                $stmt->execute($this->params);

                $this->sql = '';
                $this->params = null;


                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {

                $errorInfo = $e->getMessage();
                return array("success" => false, "message" => $errorInfo);
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

            $this->data = array("success" => true, "message" => "successfully executed");

        } catch (PDOException $e) {

            $errorInfo = $e->getMessage();
            $this->data = array("success" => false, "message" => $errorInfo);
        }

        echo json_encode($this->data);
    }

    public function select($select, $table)
    {

        $this->sql = "SELECT $select FROM $table";

        return $this;
    }

    public function insert($table, array $params)
    {

        $this->params = array_values($params);

        $this->sql .= "INSERT INTO $table (SKU, Name, Price, Type, Measurement, Size) VALUES (?, ?, ?, ?, ?, ?)";

        return $this;
    }

    public function delete($table)
    {

        $this->sql = "DELETE FROM $table";

        return $this;
    }

    public function where($column, $operator, $value)
    {

        $this->params[] = $value;

        $this->sql .= " WHERE $column $operator ?";

        return $this;
    }

    public function whereIn($column, array $value)
    {

        $this->params = $value;

        $placeholders = implode(',', array_fill(0, count($value), '?'));
        $this->sql .= " WHERE $column IN ($placeholders)";

        return $this;
    }

    public function orderBy($column, $path = "desc")
    {

        $this->sql .= " ORDER BY $column $path";

        return $this;
    }
}
