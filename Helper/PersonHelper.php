<?php

namespace CRUD\Helper;

use CRUD\Model\Person;
use PDO;

class PersonHelper
{
    public function insert(Person $person)
    {
        $fname = trim($person->getFirstName());
        $lname = trim($person->getLastName());
        $uname= trim($person->getUsername());
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("INSERT INTO Person (first_name, last_name, username)
                SELECT * FROM (SELECT '$fname', '$lname', '$uname') AS tmp
                WHERE NOT EXISTS (
                        SELECT username FROM Person WHERE username = '$uname'
                    ) LIMIT 1");

        $sth->execute();
        $count = $sth->rowCount();
        if($count>0){
            $message="<br> firstname: ".$fname." lastname: ".$lname." username: ".$uname." created successfully.";
        }else{
            $message="<br> user was not created maybe because username already exist";
        }
        echo $message;
    }

    public function fetch(int $id)
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("select * from person where id=$id");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result!=false){
            echo "personID: ".$result['id']." firstname: ".$result['first_name'].
                " lastname: ".$result['last_name']." username: ".$result['username'];
        }else{
            echo "user not found.";
        }

    }

    public function fetchAll()
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("select * from person");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo "<table><thead> <th>personID</th> <th>firstname</th> <th>lastname</th> <th>username</th></thead>";
        echo "<tbody> ";
        foreach ($result as $val){
            echo "<tr>";
            echo " <td> ".$val['id']." </td><td> ".$val['first_name'].
                " </td><td> ".$val['last_name']." </td><td> ".$val['username'];
            echo "</td> </tr>";
        }
        echo "</tbody> </table>";
    }

    public function update(Person $person)
    {
        $fname = $person->getFirstName();
        $lname = $person->getLastName();
        $uname= $person->getUsername();
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("UPDATE Person
                SET first_name='$fname',last_name='$lname'
                WHERE username='$uname'");
        $sth->execute();
        $count = $sth->rowCount();
        if($count>0){
            $message="<br> firstname: ".$fname." lastname: ".$lname." username: ".$uname." updated successfully.";
        }else{
            $message="<br> user was not updated maybe because it doesn't exist";
        }
        echo $message;
    }

    public function delete($username)
    {
        $connection = new \CRUD\Helper\DBConnector();
        $connection->connect();
        $conn=$connection->getConnection();
        $sth=$conn->prepare("DELETE FROM Person
                where username='$username'");
        $sth->execute();
        $count = $sth->rowCount();
        if($count>0){
            $message="<br> username: ".$username." deleted successfully.";
        }else{
            $message="<br> user was not deleted maybe because it doesn't exist";
        }
        echo $message;
    }

}