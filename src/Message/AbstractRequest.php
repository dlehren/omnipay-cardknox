<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox Abstract Request
 */

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

abstract class AbstractRequest extends CommonAbstractRequest
{
    /**
     * Custom field name to send the transaction ID to the notify handler.
     */
    // const TRANSACTION_ID_PARAM = 'xCustom02';

    public function getCardknoxKey()
    {
        return $this->getParameter('cardknoxKey');
    }

    public function setCardknoxKey($value)
    {
        return $this->setParameter('cardknoxKey', $value);
    }

    public function getLiveEndpoint()
    {
        return $this->getParameter('liveEndpoint');
    }

    public function setLiveEndpoint($value)
    {
        return $this->setParameter('liveEndpoint', $value);
    }

    public function getInvoice()
    {
        return $this->getParameter('invoice');
    }

    public function setInvoice($value)
    {
        return $this->setParameter('invoice', $value);
    }

    public function getPONumber()
    {
        return $this->getParameter('poNumber');
    }

    public function setPONumber($value)
    {
        return $this->setParameter('poNumber', $value);
    }

    public function getTax()
    {
        return $this->getParameter('tax');
    }

    public function setTax($value)
    {
        return $this->setParameter('tax', $value);
    }

    public function getFax()
    {
        return $this->getParameter('fax');
    }

    public function setFax($value)
    {
        return $this->setParameter('fax', $value);
    }
 
    /**
     * Base data used only for the  API.
     */
    protected function getBaseData()
    {
        $data = array();
        $data['xKey'] = $this->getCardknoxKey();
        $data['xVersion'] = '4.5.4';
        $data['xSoftwareName'] = 'omnipay';
        $data['xSoftwareVersion'] = '1';
        $data['xCommand'] = $this->action;
       
        return $data;
    }

    protected function getBillingData()
    {
        $data = array();
        $data['xAmount'] = $this->getAmount();
        $data['xTax'] = $this->getTax();
        // This is deprecated. The invoice number field is reserved for the invoice number.
        $data['xOrderID'] = $this->getTransactionId();

        $data['xPONum'] = $this->getPONumber();

        $data['xInvoice'] = $this->getInvoice();

        // A custom field can be used to pass over the merchant site transaction ID.
        // $data[static::TRANSACTION_ID_PARAM] = $this->getTransactionId();

        $data['xDescription'] = $this->getDescription();

        if ($card = $this->getCard()) {
            // customer billing details
            $data['xBillFirstName'] = $card->getBillingFirstName();
            $data['xBillLastName'] = $card->getBillingLastName();
            $data['xBillCompany'] = $card->getBillingCompany();
            $data['xBillStreet'] = trim(
                $card->getBillingAddress1()." \n".
                $card->getBillingAddress2()
            );
            $data['xBillCity'] = $card->getBillingCity();
            $data['xBillState'] = $card->getBillingState();
            $data['xBillZip'] = $card->getBillingPostcode();
            $data['xBillCountry'] = $card->getBillingCountry();
            $data['xBillPhone'] = $card->getBillingPhone();            
            $data['xFax'] = $this->getFax();
            $data['xEmail'] = $card->getEmail();

            // customer shipping details
            $data['xShipFirstName'] = $card->getShippingFirstName();
            $data['xShipLastName'] = $card->getShippingLastName();
            $data['xShipCompany'] = $card->getShippingCompany();
            $data['xShipStreet'] = trim(
                $card->getShippingAddress1()." \n".
                $card->getShippingAddress2()
            );
            $data['xShipCity'] = $card->getShippingCity();
            $data['xShipState'] = $card->getShippingState();
            $data['xShipZip'] = $card->getShippingPostcode();
            $data['xShipCountry'] = $card->getShippingCountry();
        }

        return $data;
    }

    public function sendData($data)
    {

        $data = array_filter($data);

        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();

        return $this->response = new Response($this, $httpResponse->getBody());
    }

    public function getEndpoint()
    {
        return $this->getParameter('liveEndpoint');
    }
}
