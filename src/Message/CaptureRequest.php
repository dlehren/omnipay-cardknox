<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox Capture Request
 */
class CaptureRequest extends AbstractRequest
{

    protected $action = 'cc:capture';

    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        $data = $this->getBaseData();
        $data['xAmount'] = $this->getAmount();
        $data['xRefNum'] = $this->getTransactionReference();

        return $data;
    }
}
