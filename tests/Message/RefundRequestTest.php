<?php

namespace Omnipay\Cardknox\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '12.00',
                'transactionReference' => '123456789',
                'currency' => 'USD',
                'card' => $this->getValidCard(),
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $card = $this->getValidCard();

        $this->assertSame('cc:refund', $data['xCommand']);
        $this->assertSame('123456789', $data['xRefNum']);
        $this->assertSame($card['number'], $data['xCardNum']);
        $this->assertSame('12.00', $data['xAmount']);
    }
}
