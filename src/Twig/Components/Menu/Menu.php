<?php

namespace App\Twig\Components\Menu;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Yaml\Yaml;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/menu/Menu.html.twig')]
final class Menu
{
    public array $elements;

    public string $appRoute = '#';

    public bool $connected = false;

    public function __construct(
        private readonly Security $security,
        #[Autowire(param: 'kernel.project_dir')]
        private readonly string   $projectDir,
        #[Autowire(env: 'APP_NAME')]
        public string             $appName,
    ) {}


    public function mount(): void
    {
        $elements = Yaml::parse(file_get_contents($this->projectDir . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'menu.yaml'));
        if ($home = $elements['home'] ?? null) {
            $this->appRoute = $home['route'];
        }
        $this->elements = $elements;

        if (null !== $this->security->getUser()) {
            $this->connected = true;
        }
    }
}
