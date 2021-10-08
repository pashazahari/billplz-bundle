<?php

namespace Fd\BillplzBundle\Service;

use Billplz\Client;

/**
 * @method Client getClient()
 * @method bool isSandbox()
 * @method string getBillPaymentUrl(string $billId)
 */
interface BillplzInterface
{
    public function computeRedirectSignature(array $params);
    public function computeCallbackSignature(array $params);
}