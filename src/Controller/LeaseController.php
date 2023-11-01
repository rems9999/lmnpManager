<?php

namespace App\Controller;

use App\Entity\Lease;
use App\Entity\Property;
use App\Form\LeaseType;
use App\Manager\LeaseManager;
use App\Provider\LeaseProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeaseController extends AbstractController
{
    #[Route('lease/new/{id}', name: 'user_lease_new', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function new(Property $property, Request $request, LeaseProvider $provider, LeaseManager $manager): Response
    {
        if($property->isRented()) {
            $this->addFlash('warning', 'lease.flash.new.failure');
            return $this->redirectToRoute('user_property_show', ['id' => $property->getId()]);
        }
        $lease = $provider->create($property);
        $form  = $this->createForm(LeaseType::class, $lease)
                      ->handleRequest($request)
        ;
        if($form->isSubmitted() && $form->isValid()) {
            $manager->save($lease);
            $this->addFlash('success', 'lease.flash.persist.success');
            return $this->redirectToRoute('user_property_show', ['id' => $property->getId()]);
        }
        return $this->render('lease/new.html.twig', ['form' => $form]);
    }

    #[Route('lease/end/{id}', name: 'user_lease_end', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function end(Lease $lease, LeaseManager $manager): Response
    {
        $manager->end($lease);
        return $this->redirectToRoute('user_property_show', ['id' => $lease->getProperty()->getId()]);
    }

    #[Route('lease/invoice/{id}', name: 'user_lease_invoice', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function invoice(Lease $lease): Response
    {

    }



}
