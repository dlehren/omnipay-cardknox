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
            'cardknoxKey'    => '',
            'liveEndpoint'      => 'https://x1.cardknox.com/gateway',
           
        );
    }

    public function getCardknoxKey()
    {
        return $this->getParameter('cardknoxKey');
    }

    public function setCardknoxKey($value)
    {
        return $this->setParameter('cardknoxKey', $value);
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
