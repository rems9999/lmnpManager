<?php

namespace App\Manager;

use App\Entity\Property;
use App\Event\PropertyEvent;

/**
 * @extends AbstractManager<Property, PropertyEvent>
 */
class PropertyManager extends AbstractManager
{
    protected string $eventClassName = PropertyEvent::class;
}