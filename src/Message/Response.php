<?php

namespace Omnipay\Cardknox\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Cardknox Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        parse_str($data, $this->data);
    }
   
    public function isSuccessful()
    {
        return !isset($this->data['xError']);
    }

    // public function getCode()
    // {
    //     return $this->data['xResult'];
    // }

    // public function getReasonCode()
    // {
    //     return $this->data['xStatus'];
    // }

    // public function getMessage()
    // {
    //     if (!$this->isSuccessful()) {
    //         return $this->data['xError'];
    //     }
    //     return null;
    // }
    // public function getAuthorizationCode()
    // {
    //     return $this->data['xAuthCode'];
    // }

    // public function getAVSCode()
    // {
    //     return $this->data['xAvsResultCode'];
    // }

    //  public function getTransactionReference()
    // {
    //     return $this->data['xRefNum'];
    // }

    // public function getToken()
    // {
    //     return $this->data['xToken'];
    // }

    // public function getCard()
    // {
    //     if (isset($this->data['xMaskedCardNumber'])) {
    //         return $this->data['xMaskedCardNumber'];
    //     }
    //     return null;
    // }

}
