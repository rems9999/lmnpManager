<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class LoginSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {}

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [LoginSuccessEvent::class => ['onLoginSuccess', 0]];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        /** @var User $user */
        $user = $event->getAuthenticatedToken()->getUser();
        if(null === $user->getName() || null === $user->getSurname()){
            $request = $event->getRequest();
            if($request->hasSession()) {
                $session = $request->getSession();
                if($session instanceof FlashBagAwareSessionInterface) {
                    $session->getFlashBag()->add('info', $this->translator->trans('user.flash.profile.missing'));
                    $event->setResponse(new RedirectResponse($this->urlGenerator->generate('user_profile')));
                }
            }
        }
    }
}