<?php

namespace App\Exceptions;

use Exception;
use App\Constants\AuthMessages;

class InvalidCredentialsException extends Exception
{
    /**
     * Código de estado HTTP
     *
     * @var int
     */
    protected $code = 401;

    /**
     * Constructor personalizado
     *
     * @param string|null $message
     */
    public function __construct(string $message = null)
    {
        parent::__construct($message ?? AuthMessages::INVALID_CREDENTIALS, $this->code);
    }
}
