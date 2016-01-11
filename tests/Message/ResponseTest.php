<?php

namespace Omnipay\Cardknox\Message;

use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    // /**
    //  * @expectedException Omnipay\Common\Exception\InvalidResponseException
    //  */

    
    // not sure how this works    
    // public function testConstructEmpty()
    // {
    //     $response = new Response($this->getMockRequest(), '');
    // }

    public function testAuthorizeSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('AuthorizeSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame(null, $response->getMessage());
        $this->assertSame('A', $response->getCode());
        $this->assertSame('Approved', $response->getReasonCode());
        $this->assertSame('630421', $response->getAuthorizationCode());
        $this->assertSame('NNN', $response->getAVSCode());
    }

    public function testAuthorizeFailure()
    {
        $httpResponse = $this->getMockHttpResponse('AuthorizeFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame('Invalid CVV', $response->getMessage());
        $this->assertSame('D', $response->getCode());
        $this->assertSame('Declined', $response->getReasonCode());
        $this->assertSame('',  $response->getAuthorizationCode());
        $this->assertSame('NNN', $response->getAVSCode());
    }

    public function testCaptureSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('CaptureSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame(null, $response->getMessage());
        $this->assertSame('A', $response->getCode());
        $this->assertSame('Approved', $response->getReasonCode());
        $this->assertSame('', $response->getAuthorizationCode());
        $this->assertSame('', $response->getAVSCode());
    }

    public function testCaptureFailure()
    {
        $httpResponse = $this->getMockHttpResponse('CaptureFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame('Original transaction not specified', $response->getMessage());
        $this->assertSame('E', $response->getCode());
        $this->assertSame('Error', $response->getReasonCode());
        $this->assertSame('000000', $response->getAuthorizationCode());
    }

    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame(null , $response->getMessage());
        $this->assertSame('A', $response->getCode());
        $this->assertSame('Approved', $response->getReasonCode());
        $this->assertSame('230809', $response->getAuthorizationCode());
        $this->assertSame('YYY', $response->getAVSCode());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame('Invalid CVV', $response->getMessage());
        $this->assertSame('D', $response->getCode());
        $this->assertSame('Declined', $response->getReasonCode());
        $this->assertSame( '', $response->getAuthorizationCode());
        $this->assertSame('NNN', $response->getAVSCode());
    }

    public function testRefundSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('RefundSuccess.txt');

        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame(null , $response->getMessage());
        $this->assertSame('A', $response->getCode());
        $this->assertSame('Approved', $response->getReasonCode());
        $this->assertSame('', $response->getAVSCode());
    }

    public function testRefundFailure()
    {
        $httpResponse = $this->getMockHttpResponse('RefundFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('123456789', $response->getTransactionReference());
        $this->assertSame('UNSUPPORTED CARD TYPE', $response->getMessage());
        $this->assertSame('D', $response->getCode());
        $this->assertSame('Declined', $response->getReasonCode());
        $this->assertSame('', $response->getAuthorizationCode());
        $this->assertSame('', $response->getAVSCode());
    }
}
