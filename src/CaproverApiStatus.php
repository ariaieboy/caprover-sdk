<?php

namespace Ariaieboy\CaproverSdk;

class CaproverApiStatus
{
    //Api Possible Errors
    public const OKAY = 100;
    public const OKAY_BUILD_START = 101;
    public const STATUS_ERROR_GENERIC = 1000;
    public const STATUS_ERROR_CAPTAIN_NOT_INITIALIZED = 1001;
    public const STATUS_ERROR_USER_NOT_INITIALIZED = 1101;
    public const STATUS_ERROR_NOT_AUTHORIZED = 1102;
    public const STATUS_ERROR_ALREADY_EXIST = 1103;
    public const STATUS_ERROR_BAD_NAME = 1104;
    public const STATUS_WRONG_PASSWORD = 1105;
    public const STATUS_AUTH_TOKEN_INVALID = 1106;
    public const VERIFICATION_FAILED = 1107;

    public const UNKNOWN_ERROR = 1999;
}
