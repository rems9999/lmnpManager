<?php

namespace App\Twig\Components\Form;

use Symfony\Component\Form\FormView;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/form/FormRowCol.html.twig')]
final class FormRowCol
{
    /**
     * @var FormView[]
     */
    public array $elements = [];

    public function getWidth(): int
    {
        return ceil(12 / count($this->elements));
    }

}
