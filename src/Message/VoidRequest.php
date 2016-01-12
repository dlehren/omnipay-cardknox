<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox Void Request
 */
class VoidRequest extends AbstractRequest
{
    protected $action = 'cc:void';

    public function getData()
    {
        $this->validate('transactionReference');

        $data = $this->getBaseData();
        $data['xIP'] = $this->getClientIp();
        $data['xRefNum'] = $this->getTransactionReference();

        return $data;
    }
}
