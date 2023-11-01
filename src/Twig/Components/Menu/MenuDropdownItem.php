<?php

namespace App\Twig\Components\Menu;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/menu/MenuDropdownItem.html.twig')]
final class MenuDropdownItem
{
    public string $route;
    public string $label = '';
    public string $icon = '';
}
