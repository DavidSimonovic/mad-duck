<?php

namespace App\Helpers;

class HttpCode
{
    const SUCCESS = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;
    const BAD_REQUEST = 400;
    const UNAUTHENTICATED = 401;
    const PAYMENT_REQUIRED = 402;
    const UNAUTHORIZED = 403;
    const NOT_FOUND = 404;

    const CODES = [
        self::SUCCESS,
        self::CREATED,
        self::NO_CONTENT,
        self::BAD_REQUEST,
        self::UNAUTHENTICATED,
        self::PAYMENT_REQUIRED,
        self::UNAUTHORIZED,
        self::NOT_FOUND
    ];
}
