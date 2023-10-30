<?php

namespace App\Twig\Components\Alert;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/alert/Alert.html.twig')]
final class Alert
{

    private array $icons = [
        'success' => '<span class="me-2"><i class="fas fa-check-circle"></i></span>',
        'danger' => '<span class="me-2"><i class="fas fa-exclamation-circle"></i></span>',
        'warning' => '<span class="me-2"><i class="fas fa-exclamation-circle"></i></span>',
        'info' => '<span class="me-2"><i class="fas fa-question-circle"></i></span>',
    ];
    public string $type;
    public string $message;

    public function getIcon(): string
    {
        return $this->icons[$this->type] ?? '';
    }
}
