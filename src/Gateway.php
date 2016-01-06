<?php

namespace Omnipay\Cardknox;

use Omnipay\Common\AbstractGateway;

/**
 * Cardknox  Class
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Cardknox';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiLoginId'        => '',
            'transactionKey'    => '',
            'testMode'          => false,
            'developerMode'     => false,
            'liveEndpoint'      => 'https://secure2.authorize.net/gateway/transact.dll',
            'developerEndpoint' => 'https://test.authorize.net/gateway/transact.dll',
        );
    }

    public function getApiLoginId()
    {
        return $this->getParameter('apiLoginId');
    }

    public function setApiLoginId($value)
    {
        return $this->setParameter('apiLoginId', $value);
    }

    public function getTransactionKey()
    {
        return $this->getParameter('transactionKey');
    }

    public function setTransactionKey($value)
    {
        return $this->setParameter('transactionKey', $value);
    }

    public function getDeveloperMode()
    {
        return $this->getParameter('developerMode');
    }

    public function setDeveloperMode($value)
    {
        return $this->setParameter('developerMode', $value);
    }

    public function setEndpoints($endpoints)
    {
        $this->setParameter('liveEndpoint', $endpoints['live']);
        return $this->setParameter('developerEndpoint', $endpoints['developer']);
    }

    public function getLiveEndpoint()
    {
        return $this->getParameter('liveEndpoint');
    }

    public function setLiveEndpoint($value)
    {
        return $this->setParameter('liveEndpoint', $value);
    }

    public function getDeveloperEndpoint()
    {
        return $this->getParameter('developerEndpoint');
    }

    public function setDeveloperEndpoint($value)
    {
        return $this->setParameter('developerEndpoint', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardknox\Message\AuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardknox\Message\CaptureRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardknox\Message\PurchaseRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardknox\Message\VoidRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardknox\Message\RefundRequest', $parameters);
    }
}
