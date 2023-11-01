<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Manager\PropertyManager;
use App\Provider\PropertyProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'user_property_index')]
    public function index(PropertyProvider $provider): Response
    {
        return $this->render('property/index.html.twig', ['properties' => $provider->findByUser($this->getUser())]);
    }

    #[Route('property/new', name: 'user_property_new', requirements: [], methods: ['GET', 'POST'])]
    public function new(Request $request, PropertyProvider $provider, PropertyManager $manager): Response
    {
        $property = $provider->create($this->getUser());
        $form     = $this->createForm(PropertyType::class, $property)
                         ->handleRequest($request)
        ;
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->save($property);
            $this->addTransFlash('success', 'property.flash.new.success');
            return $this->redirectToRoute('user_property_index');
        }
        return $this->render('property/new.html.twig', ['form' => $form]);
    }

    #[Route('property/edit/{id}', name: 'user_property_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Property $property, Request $request, PropertyManager $manager): Response
    {
        $form = $this->createForm(PropertyType::class, $property)
                     ->handleRequest($request)
        ;
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->save($property);
            $this->addTransFlash('success', 'property.flash.new.success');
            return $this->redirectToRoute('user_property_index');
        }
        return $this->render('property/edit.html.twig', ['form' => $form, 'property' => $property]);
    }


    #[Route('property/show/{id}', name: 'user_property_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Property $property): Response
    {

        return $this->render('property/show.html.twig', ['property' => $property]);
    }


}
