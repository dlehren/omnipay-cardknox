<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox Refund Request
 */
class RefundRequest extends AbstractRequest
{

    protected $action = 'cc:refund';
    
    public function getData()
    {
        $data = $this->getBaseData('RefundTransaction');

        $this->validate('amount', 'transactionReference');

        $data['xIP'] = $this->getClientIp();
        $data['xRefNum'] = $this->getTransactionReference();
        $data['xCardNum'] = $this->getCard()->getNumber();
        $data['xExp'] = $this->getCard()->getExpiryDate('my');
        $data['xCVV'] = $this->getCard()->getCvv();

        $data['xAmount'] = $this->getAmount();

        return $data;
    }
}
