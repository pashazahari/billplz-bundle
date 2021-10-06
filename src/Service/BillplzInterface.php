<?php

namespace Fd\BillplzBundle\Service;

use Billplz\Client;

/**
 * @method Client getClient()
 * @method bool isSandbox()
 * @method string getBillPaymentUrl(string $billId)
 * @method string|false computeRedirectSignature(array $params)
 * @method string|false computeRedirectSignature(array $params)
 */
interface BillplzInterface
{

}