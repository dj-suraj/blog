<?php

namespace AppBundle\Model;

class User
{

    public $username = "";
    public $active = "";

    public function __construct($id, $username, $active)
    {
        $this->id = $id;
        $this->username = $username;
        $this->active = $active;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getActive()
    {
        return $this->active;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setActive($active)
    {
        $this->active = $active;
    }
}
