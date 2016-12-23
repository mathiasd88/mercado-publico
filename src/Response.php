<?php

class Response
{
    protected $status;

    protected $message;

    public function __construct($status, $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}
