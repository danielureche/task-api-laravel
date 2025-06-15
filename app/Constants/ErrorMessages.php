<?php

namespace App\Constants;

final class ErrorMessages
{
    private function __construct()
    {
    }

    public const UNAUTHORIZED = 'You are not authorized to perform this action.';
    public const NOT_FOUND = 'The requested resource was not found.';
    public const VALIDATION_FAILED = 'Validation failed. Please check your input.';
    public const SERVER_ERROR = 'An unexpected error occurred. Please try again later.';
    public const FORBIDDEN = 'You do not have permission to access this resource.';
}