<?php

namespace Omnipay\Cardknox;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $voidOptions;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->purchaseOptions = array(
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        );

        $this->captureOptions = array(
            'amount' => '10.00',
            'transactionReference' => '12345',
        );

        $this->voidOptions = array(
            'transactionReference' => '12345',
        );
    }

    public function testAuthorizeSuccess()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->authorize($this->purchaseOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2184493132', $response->getTransactionReference());
        $this->assertSame('This transaction has been approved.', $response->getMessage());
    }

    public function testAuthorizeFailure()
    {
        $this->setMockHttpResponse('Dovid_CardknoxAuthorizeFailure.txt');

        $response = $this->gateway->authorize($this->purchaseOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('0', $response->getTransactionReference());
        $this->assertSame('A valid amount is required.', $response->getMessage());
    }

    public function testCaptureSuccess()
    {
        $this->setMockHttpResponse('Dovid_CardknoxCaptureSuccess.txt');

        $response = $this->gateway->capture($this->captureOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2184494531', $response->getTransactionReference());
        $this->assertSame('This transaction has been approved.', $response->getMessage());
    }

    public function testCaptureFailure()
    {
        $this->setMockHttpResponse('Dovid_CardknoxCaptureFailure.txt');

        $response = $this->gateway->capture($this->captureOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('0', $response->getTransactionReference());
        $this->assertSame('The transaction cannot be found.', $response->getMessage());
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('Dovid_CardknoxPurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('2184492509', $response->getTransactionReference());
        $this->assertSame('This transaction has been approved.', $response->getMessage());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('Dovid_CardknoxPurchaseFailure.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('0', $response->getTransactionReference());
        $this->assertSame('A valid amount is required.', $response->getMessage());
    }

    public function testVoidSuccess()
    {
        $this->setMockHttpResponse('Dovid_CardknoxVoidSuccess.txt');

        $response = $this->gateway->void($this->voidOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('0', $response->getTransactionReference());
        $this->assertSame('This transaction has already been voided.', $response->getMessage());
    }

    public function testVoidFailure()
    {
        $this->setMockHttpResponse('Dovid_CardknoxVoidFailure.txt');

        $response = $this->gateway->void($this->voidOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('0', $response->getTransactionReference());
        $this->assertSame('A valid referenced transaction ID is required.', $response->getMessage());
    }

}
