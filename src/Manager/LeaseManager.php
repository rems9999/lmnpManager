<?php

namespace App\Manager;

use App\Entity\Lease;
use App\Event\LeaseEvent;
use App\Manager\AbstractManager;
use Symfony\Component\Clock\ClockAwareTrait;

/**
 * @extends AbstractManager<Lease, LeaseEvent>
 */
class LeaseManager extends AbstractManager
{
    use ClockAwareTrait;
    protected string $eventClassName = LeaseEvent::class;

    public function end(Lease $lease): void
    {
        $lease->setEndedAt($this->now());
        $this->save($lease);
    }

}