<?php

namespace Root\Html\Entity;

class Job
{
    public $id;
    public $title;
    public $description;
    public $active;
    public $date;

    public function isValid(): bool
    {
        return
            isset($this->title)           &&
            isset($this->description)     &&
            isset($this->active)          &&
            is_string($this->title)       &&
            is_string($this->description) &&
            is_string($this->active)      &&
            !empty($this->title)          &&
            !empty($this->description)    &&
            !empty($this->active);
    }
}