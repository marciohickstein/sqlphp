<?php

/**
 * Show message with break line in HTML
 *
 * @param  string $message
 *
 * @return void
 */
function showMessage($message)
{
    echo $message . "</br>";
}

/**
 * Show exception message
 *
 * @param  Exception $e
 *
 * @return void
 */
function showException(Exception $e)
{
    showMessage("Error: " . $e->getMessage());
}

/**
 * Show exception message and abort execution php
 *
 * @param  Exception $e
 *
 * @return void
 */
function showExceptionAndAbort(Exception $e)
{
    echo "Error: " . $e->getMessage();
    exit($e->getCode());
}

?>