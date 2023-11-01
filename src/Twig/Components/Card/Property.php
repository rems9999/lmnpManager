<?php

namespace App\Twig\Components\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Property as PropertyEntity;

#[AsTwigComponent(template: 'components/card/Property.html.twig')]
final class Property
{
    public int $id;
    public string $name;
    public bool $rented;
    public string $address;

    public function mount(PropertyEntity $property): void
    {
        $this->name = $property->getName();
        $this->rented = $property->isRented();
        $this->address = $property->getAddress();
        $this->id = $property->getId();
    }
}
