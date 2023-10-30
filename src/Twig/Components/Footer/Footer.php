<?php

namespace App\Twig\Components\Footer;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/footer/Footer.html.twig')]
final class Footer
{
    public function __construct(
        #[Autowire(env: 'APP_NAME')]
        public string $appName,
    ) {}
}
