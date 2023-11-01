<?php

namespace App\Twig\Components\Menu;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/menu/MenuElement.html.twig')]
final class MenuElement
{
    public string $route;
    public string $label = '';
    public string $icon = '';
}
