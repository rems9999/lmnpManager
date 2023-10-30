<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'public_registration_register')]
    public function register(Request $request, UserManager $manager): Response
    {
        $user = $manager->createNew();
        $form = $this->createForm(UserType::class, $user)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if(!$manager->isValid($user, $form->get('repeatPassword')->getData())) {
                $this->addTransFlash('danger', 'user.flash.password.failure');
            }
            $manager->hashPassword($user);
            $manager->save($user);
            return $this->redirectToRoute('public_login');
        }
        return $this->render('registration/index.html.twig', ['form' => $form]);
    }
}
