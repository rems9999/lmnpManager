<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'user_profile')]
    public function index(Request $request, UserManager $manager): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user)
                     ->handleRequest($request)
        ;
        if($form->isSubmitted() && $form->isValid()){
            $manager->save($user);
            if ($manager->isComplete($user)) {
                $this->addTransFlash('success', 'user.flash.profile.success');
            }
            return $this->redirectToRoute('public_home');
        }

        return $this->render('profile/index.html.twig', ['form' => $form]);
    }
}
