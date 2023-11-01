<?php

namespace App\Twig\Components\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Lease as LeaseEntity;

#[AsTwigComponent(template: 'components/card/Lease.html.twig')]
final class Lease
{
    public int    $id;
    public string $tenant;
    public string $startedAt;
    public string $endedAt;

    public function mount(LeaseEntity $lease): void
    {
        $this->id        = $lease->getId();
        $this->tenant    = sprintf(
            '%s %s',
            $lease->getTenant()->getSurname(),
            $lease->getTenant()->getName()
        );
        $this->startedAt = $lease->getStartedAt()?->format('d/m/Y') ?? '';
        $this->endedAt   = $lease->getEndedAt()?->format('d/m/Y') ?? '';
    }
}
