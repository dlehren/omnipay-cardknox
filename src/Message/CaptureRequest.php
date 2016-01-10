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
        $data['x_amount'] = $this->getAmount();
        $data['x_trans_id'] = $this->getTransactionReference();

        return $data;
    }
}
