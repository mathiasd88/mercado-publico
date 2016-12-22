<?php

class Response
{
    protected $status;

    protected $message;

    function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}