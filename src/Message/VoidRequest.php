<?php

namespace Dlehren\Cardknox\Message;

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
        $data['x_trans_id'] = $this->getTransactionReference();

        return $data;
    }
}
