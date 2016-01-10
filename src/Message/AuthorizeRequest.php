<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox  Authorize Request
 */
class AuthorizeRequest extends AbstractRequest
{

    protected $action = 'cc:authonly';

    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        $data = $this->getBaseData();
        $data['xIP'] = $this->getClientIp();
        $data['xCardNum'] = $this->getCard()->getNumber();
        $data['xExp'] = $this->getCard()->getExpiryDate('my');
        $data['xCVV'] = $this->getCard()->getCvv();
        
        return array_merge($data, $this->getBillingData());
    }
}
