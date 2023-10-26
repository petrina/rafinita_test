<?php

namespace App\Services;

use App\DTO\SendSaleDTO;
use App\Forms\SaleForm;
use App\Rafinita\Curl\SaleRafinitaCurl;
use App\Rafinita\Entity\SaleEntity;
use Exception;
use Symfony\Component\Form\FormError;

class HomeService extends AbstractService
{

    private SaleRafinitaCurl $saleRafinitaRequest;

    public function __construct(
//        SaleRafinitaCurl $saleRafinitaRequest
    )
    {
//        $this->saleRafinitaRequest = $saleRafinitaRequest;
        $this->saleRafinitaRequest = new SaleRafinitaCurl();
    }

    /**
     * @throws Exception
     */
    public function sendSale($request, $ip): SendSaleDTO
    {
        $saleEntity = new SaleEntity();
        $saleEntity->setPayerIp($ip);

        $form = $this->createForm(SaleForm::class, $saleEntity);
        $form->handleRequest($request);

        $responseBody = null;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SaleEntity $saleEntity */
            $saleEntity = $form->getData();
            $responseEntity = $this->saleRafinitaRequest->send($saleEntity->getRequestDTO());
            $responseJson = $responseEntity->getJson();
            $responseBody = $responseEntity->getBody();

            if ($responseJson->result === 'ERROR') {
                foreach ($responseJson->errors as $error) {
                    $errorMsgArray = explode(':', $error->error_message);
                    $fieldName = reset($errorMsgArray);
                    if ($fieldName === '' || $fieldName === 'hash') {
                        $form->addError(new FormError(end($errorMsgArray)));
                    } else {
                        $form->get($this->toCamelCase($fieldName))->addError(new FormError(end($errorMsgArray)));
                    }
                }
            }
        }

        return new SendSaleDTO($form, $responseBody);
    }

    private function toCamelCase(string $snakeCase): string
    {
        $snakeCaseArray = explode('_', $snakeCase);
        foreach ($snakeCaseArray as $key => $value) {
            if ($key === 0) {
                continue;
            }
            $snakeCaseArray[$key] = ucfirst($value);
        }
        return implode('', $snakeCaseArray);
    }
}