<?php

namespace Root\Html\Entity;

class User
{
    public $id;
    public $name;
    public $email;
    public $password;

    public function isValid()
    {
        return
            isset($this->name)         &&
            isset($this->email)        &&
            isset($this->password)     &&
            !empty($this->name)        &&
            !empty($this->email)       &&
            !empty($this->password)    &&
            is_string($this->name)     &&
            is_string($this->email)    &&
            is_string($this->password);
    }
}