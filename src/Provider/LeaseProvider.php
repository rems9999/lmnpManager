<?php

namespace App\Provider;

use App\Entity\Lease;
use App\Entity\Payment;
use App\Entity\Property;
use App\Repository\LeaseRepository;
use Symfony\Component\Clock\ClockAwareTrait;

class LeaseProvider
{
    use ClockAwareTrait;

    public function __construct(private readonly LeaseRepository $repository) {}

    public function create(Property $property): Lease
    {
        return (new Lease())->setProperty($property);
    }

    public function createPayment(Lease $lease): Payment
    {
        return (new Payment())
            ->setLease($lease)
            ->setAmount($lease->getRent() + $lease->getCharge())
            ->setPaidAt($this->now())
        ;
    }
}