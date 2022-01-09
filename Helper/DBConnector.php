<?php

namespace CRUD\Helper;
use PDO;

class DBConnector
{

    /** @var mixed $db */
    private $db;
    /**
     * @var \PDO $connection
     */
    private $connection;

    public function __construct( )
    {
        $this->db="crud";
    }

    /**
     * @throws \Exception
     * @return void
     */
    public function connect() : void
    {
        $servername = "localhost";
        $username = "root";
        $password = "1895Th1895!";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$this->db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection=$conn;
        } catch(PDOException $e) {
            ECHO "<h3>CANNOT CONNECT TO SERVER<h3/>";
            echo  $e->getMessage();
        }
//        echo "connected";
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {
        try {
            $this->connection->exec($query);
        } catch(PDOException $e) {
            echo "user not found"."<br>" ;
//            $this->exceptionHandler($e->getMessage());
            return false;
        }
        return true;
    }

    /**
     * @param string $message
     * @throws \Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
        echo $message();
    }

    /**
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * @param \PDO $connection
     */
    public function setConnection(\PDO $connection): void
    {
        $this->connection = $connection;
    }


}