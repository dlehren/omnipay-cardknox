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

        $data['xRefNum'] = $this->getTransactionReference();
        $data['xCardNum'] = $this->getCard()->getNumber();
        $data['xExp'] = $this->getCard()->getExpiryDate('my');
        $data['xAmount'] = $this->getAmount();

        return $data;
    }
}
