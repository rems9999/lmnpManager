<?php

namespace App\Provider;

use App\Entity\Property;
use App\Entity\User;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class PropertyProvider
{
    public function __construct(private readonly PropertyRepository $repository) {}

    public function create(User $user): Property
    {
        return (new Property())
                ->setUser($user)
            ;
    }

    public function findByUser(UserInterface $user): Collection
    {
        return new ArrayCollection($this->repository->findByUser($user));
    }
}