<?php

namespace App\Enum;

enum PersistContext
{
    case INSERT;
    case UPDATE;
    case DELETE;
}
