<?php

namespace Fd\BillplzBundle\Service;

use Billplz\Client;
use Laravie\Codex\Contracts\Response;

interface BillplzInterface
{
    public function getClient(): Client;
    public function isSandbox(): bool;
    public function getBillPaymentUrl(string $billId): string;
    public function getAllConfiguration(): array;
    public function getCurrentConfiguration(): array;
    public function computeRedirectSignature(array $params);
    public function computeCallbackSignature(array $params);
    public function createBill(string $collectionKey, ?string $email = null, ?string $mobile = null, string $name = null, int|string $amount = null, string $callbackUrl = null, string $description = null, array $optional = []): Response;
}
