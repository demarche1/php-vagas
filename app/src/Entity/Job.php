<?php

namespace Root\Html\Entity;

class Job
{
    public $id;
    public $title;
    public $description;
    public $active;
    public $date;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
    }
}
