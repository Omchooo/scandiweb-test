<?php
require_once('./config.php');

class DB
{
    private $servername,
            $username,
            $password,
            $dbname;
    protected $connection;

    public function __construct()
    {
        $this->setServerName();
        $this->setUsername();
        $this->setDatabaseName();
        $this->setPassword();
        $this->setConnection();
    }

    public function setServerName($servername = DBHOST)
    {
        $this->servername = $servername;
    }

    public function getServerName()
    {
        return $this->servername;
    }

    public function setUsername($username = DBUSER)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password = DBPASSWORD)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setDatabaseName($dbname = DBNAME)
    {
        $this->dbname = $dbname;
    }

    public function getDatabaseName()
    {
        return $this->dbname;
    }
    public function setConnection()
    {
        try {
            $dsn = "mysql:dbname=$this->dbname;host=$this->servername";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            // echo "connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

}
