<?php

namespace Omnipay\Cardknox\Message;

/**
 * Cardknox Void Request
 */
class VoidRequest extends AbstractRequest
{
    protected $action = 'VOID';

    public function getData()
    {
        $this->validate('transactionReference');

        $data = $this->getBaseData();
        $data['xRefNum'] = $this->getTransactionReference();

        return $data;
    }
}
