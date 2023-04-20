<?php

namespace Scrapper\Http;

enum Codes: int
{
    case UNKNOWN = 0;
    case ONLINE = 200;
    case OFFLINE = 400;
    case NOT_FOUND = 404;
    case NOT_ALLOWED = 405;
    case CANNOT_CONNECT = 1;
}
