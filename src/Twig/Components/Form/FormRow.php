<?php

namespace App\Twig\Components\Form;

use Symfony\Component\Form\FormView;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/form/FormRow.html.twig')]
final class FormRow
{
    public FormView $form;
    public string   $label;
}
