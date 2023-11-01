<?php

namespace App\Provider;

use App\Entity\Lease;
use App\Entity\Property;
use App\Repository\LeaseRepository;

class LeaseProvider
{

    public function __construct(private readonly LeaseRepository $repository) {}

    public function create(Property $property): Lease
    {
        return (new Lease())->setProperty($property);
    }
}