<?php

namespace App\Publisher;

use App\Entity\Lease;
use App\Entity\Payment;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use function Symfony\Component\String\u;

class InvoicePublisher
{
    protected $template = 'pdf/invoice.html.twig';

    public function __construct(
        private readonly Html2Pdf $publisher,
        private readonly Environment $twig,
        private readonly TranslatorInterface $translator
    ) {}

    public function publish(Payment $payment): void
    {
        $html = $this->twig->render('pdf/invoice.html.twig', $this->getArguments($payment));
        $this->publisher->writeHTML($html);
        $this->publisher->output();
    }

    private function getArguments(Payment $payment): array
    {
        $user = $payment->getLease()->getProperty()->getUser();
        $userFullName = sprintf(
            '%s %s',
            $user->getName(),
            $user->getSurname()
        );
        $date = $payment->getPaidAt();
        return  [
            'user' => [
                'name' => $userFullName,
                'address' => $user->getAddress()
                ],
            'tenant' => $payment->getLease()->getTenant(),
            'property' => $payment->getLease()->getProperty(),
            'lease' => $payment->getLease(),
            'date' => $date,
            'month' => u($this->translator->trans($date->format('F')))->upper(),
            'year' => $date->format('Y'),
            'day' => $date->format('d'),
        ];
    }

}