<?php

/**
 * Verify if it has an ID into URL GET params.
 *
 * @return bool
 */
function hasIdIntoUrlParams (): bool
{
    return isset($_GET['id']) || is_numeric($_GET['id']);
}