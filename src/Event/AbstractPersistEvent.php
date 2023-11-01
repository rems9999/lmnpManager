<?php

namespace App\Event;

use App\Entity\Property;
use App\Enum\PersistContext;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @template TEntity as object
 */
class AbstractPersistEvent extends Event
{
    private bool $persisted = false;

    /**
     * @param TEntity $subject
     */
    public function __construct(
        private readonly object $subject,
        private readonly PersistContext $context,
    ) {}

    public function isPersisted(): bool
    {
        return $this->persisted;
    }

    public function persist(): self
    {
        $this->persisted = true;
        return $this;
    }

    /**
     * @return TEntity
     */
    public function getSubject(): object
    {
        return $this->subject;
    }

    public function getContext(): PersistContext
    {
        return $this->context;
    }

    public function isInsert(): bool
    {
        return PersistContext::INSERT === $this->context;
    }

    public function isUpdate(): bool
    {
        return PersistContext::UPDATE === $this->context;
    }

    public function isDelete(): bool
    {
        return PersistContext::DELETE === $this->context;
    }
}