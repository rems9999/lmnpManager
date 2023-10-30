<?php

namespace App\Twig\Components\Menu;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/menu/MenuDropdown.html.twig')]
final class MenuDropdown
{
    public string $label;
    public array  $children;
}
