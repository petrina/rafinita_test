<?php

namespace App\DTO;

use Symfony\Component\Form\FormInterface;

class SendSaleDTO extends AbstractResponseDTO
{

    private FormInterface $form;
    private ?string $responseBody;

    public function __construct(FormInterface $form, ?string $responseBody = null)
    {
        $this->form = $form;
        $this->responseBody = $responseBody;
    }

    public function serialize(): array
    {
        return [
            'form' => $this->form,
            'responseBody' => $this->responseBody
        ];
    }
}