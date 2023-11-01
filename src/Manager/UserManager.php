<?php

namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Clock\ClockAwareTrait;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class UserManager
{
    use ClockAwareTrait;
    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly EventDispatcherInterface $dispatcher,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function createNew(): User
    {
        return (new User())->setCreatedAt($this->now());
    }

    public function save(User $user): void
    {
        if($user->getAddress()->isEmpty()){
            $user->setAddress(null);
        }
        $this->manager->persist($user);
        $this->manager->flush();
    }

    public function isValid(User $user, string $repeatPassword): bool
    {
        return $user->getPassword() === $repeatPassword;
    }

    /**
     * @param User $user
     * @return void
     */
    public function hashPassword(User $user): void
    {
        $plainPassword  = $user->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);
    }


}