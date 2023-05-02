<?php

namespace Database;

class DB
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    protected $connection;

    public function __construct()
    {
        $this->setServerName();
        $this->setUsername();
        $this->setDatabaseName();
        $this->setPassword();
        $this->setConnection();
    }

    public function setServerName(string $servername = DBHOST)
    {
        $this->servername = $servername;
    }

    public function getServerName()
    {
        return $this->servername;
    }

    public function setUsername(string $username = DBUSER)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword(string $password = DBPASSWORD)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setDatabaseName(string $dbname = DBNAME)
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
            $this->connection = new \PDO($dsn, $this->username, $this->password);
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
