<?php

namespace App\Enum;

enum WayType: string
{
    case STREET = 'rue';
    case AVENUE = 'av.';
    case BOULEVARD = 'bd.';
    case PATH = 'ch.';
    case PLACE = 'pl.';
}
