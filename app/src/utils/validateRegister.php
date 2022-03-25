<?php

/**
 * Validate if is a valid register.
 *
 * @param string $title
 * @param string $description
 * @param string $active
 * @return boolean
 */
function isValidRegister($title, $description, $active)
{
    return
        isset($title)           &&
        isset($description)     &&
        isset($active)          &&
        is_string($title)       &&
        is_string($description) &&
        is_string($active)      &&
        !empty($title)          &&
        !empty($description)    &&
        !empty($active);
}
