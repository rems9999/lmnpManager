<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractControllerAlias;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbstractController extends SymfonyAbstractControllerAlias
{

    public function __construct(private readonly TranslatorInterface $translator) {}

    public function addTransFlash(string $type, string $message, array $options = []): void
    {
        $translated = $this->translator->trans($message, $options);
        $this->addFlash($type, $translated);
    }

    public function getUser(): User
    {
        return parent::getUser();
    }
}