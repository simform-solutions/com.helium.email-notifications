<?php

namespace Helium\EmailNotifications\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class MessageConfigException extends HttpException
{
    public function __construct(string $message)
    {
        parent::__construct(500, $message);
    }
}