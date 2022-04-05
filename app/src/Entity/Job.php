<?php

namespace Root\Html\Entity;

class Job
{
    public $id;
    public $title;
    public $description;
    public $active;
    public $date;
    public $user_id;

    public function isValid(): bool
    {
        return
            isset($this->title)           &&
            isset($this->description)     &&
            isset($this->active)          &&
            isset($this->user_id)         &&
            is_string($this->title)       &&
            is_string($this->description) &&
            is_string($this->active)      &&
            is_string($this->user_id)     &&
            !empty($this->title)          &&
            !empty($this->description)    &&
            !empty($this->active)         &&
            !empty($this->user_id);
    }
}