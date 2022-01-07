<?php

namespace CRUD\Controller;

use CRUD\Helper\PersonHelper;
use CRUD\Model\Actions;
use CRUD\Model\Person;

class PersonController
{
    public function switcher($uri,$request)
    {
        switch ($uri)
        {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $firstname=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        $username=$_POST["username"];
        $person = new Person($firstname,$lastName,$username);
        $personHelper = new PersonHelper();
        $personHelper->insert($person);
    }

    public function updateAction($request)
    {
        $firstname=$_POST["firstName"];
        $lastName=$_POST["lastName"];
        $username=$_POST["username"];
        $person = new Person($firstname,$lastName,$username);
        $personHelper = new PersonHelper();
        $personHelper->update($person);
    }

    public function readAction($request)
    {
        $id=$_GET["id"];
        $personHelper = new PersonHelper();
        $personHelper->fetch($id);
    }
    public function readAllAction($request)
    {
        $personHelper = new PersonHelper();
        $personHelper->fetchAll();
    }

    public function deleteAction($request)
    {
        $username=$_POST["username"];
        $personHelper = new PersonHelper();
        $personHelper->delete($username);
    }

}