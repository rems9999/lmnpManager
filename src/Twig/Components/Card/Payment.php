<?php

namespace App\Twig\Components\Card;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Entity\Payment as PaymentEntity;

#[AsTwigComponent(template: 'components/card/Payment.html.twig')]
final class Payment
{
    public int    $id;
    public string $paidAt;
    public string $amount;
    public bool  $publishable;

    public function mount(PaymentEntity $payment): void
    {
        $this->id = $payment->getId();
        $this->paidAt = $payment->getPaidAt()?->format('d/m/Y') ?? '';
        $this->amount = sprintf('%d €', $payment->getAmount());
        $lease = $payment->getLease();
        $this->publishable = $payment->getAmount() === $lease->getTotalDue();
    }
}
