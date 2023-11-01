<?php

namespace App\Manager;

use App\Enum\PersistContext;
use App\Event\AbstractPersistEvent;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;


/**
 * @template TEntity of object
 * @template TEvent of AbstractPersistEvent
 */
class AbstractManager
{
    /**
     * @var class-string<TEvent>
     */
    protected string $eventClassName;


    public function __construct(
        protected readonly EntityManagerInterface   $manager,
        protected readonly EventDispatcherInterface $dispatcher,
    ) {}

    /**
     * @param TEntity $subject
     */
    public function save(object $subject): void
    {
        $event = $this->getEvent($subject);
        $this->dispatcher->dispatch($event);
        $this->manager->persist($subject);
        $this->manager->flush();
        $event->persist();
        $this->dispatcher->dispatch($event);
    }

    /**
     * @param TEntity $subject
     */
    public function remove(object $subject): void
    {
        $event = $this->getDeleteEvent($subject);
        $this->dispatcher->dispatch($event);
        $this->manager->remove($subject);
        $this->manager->flush();
        $event->persist();
        $this->dispatcher->dispatch($event);
    }

    /**
     * @param TEntity $subject
     * @return TEvent
     */
    protected function getEvent(object $subject): AbstractPersistEvent
    {
        $eventClassName = $this->eventClassName;
        $context = $this->getContext($subject);
        return new $eventClassName($subject, $context);
    }

    /**
     * @param TEntity $subject
     * @return TEvent
     */
    protected function getDeleteEvent(object $subject): AbstractPersistEvent
    {
        $eventClassName = $this->eventClassName;
        $context = PersistContext::DELETE;
        return new $eventClassName($subject, $context);
    }

    /**
     * @param TEntity $subject
     */
    private function getContext(object $subject): PersistContext
    {
        return null === $subject->getId() ? PersistContext::INSERT : PersistContext::UPDATE;
    }
}