<?php

namespace Dlehren\Cardknox\Message;

/**
 * Cardknox  Purchase Request
 */
class PurchaseRequest extends AuthorizeRequest
{
    protected $action = 'AUTH_CAPTURE';
}
