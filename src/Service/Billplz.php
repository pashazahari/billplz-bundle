<?php

namespace Fd\BillplzBundle\Service;

use Billplz\Client;

class Billplz implements BillplzInterface
{
    private Client $client;

    private array $config;

    public function __construct
    (
        array $config
    )
    {
        $this->client = $config['sandbox'] == false ? Client::make($config['api_key'], $config['signature_key']) : Client::make($config['sandbox_api_key'], $config['sandbox_signature_key'])->useSandbox();
        $this->config = $config;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function isSandbox(): bool
    {
        return $this->config['sandbox'];
    }

    public function getBillPaymentUrl(string $billId)
    {
        return $this->config['sandbox'] == true ? sprintf('https://www.billplz-sandbox.com/bills/%s', $billId) : sprintf('https://www.billplz.com/bills/%s', $billId);
    }

    public function computeRedirectSignature(array $params)
    {
        $data = [
            'billplzid' . $params['billplz[id]'],
            'billplzpaid_at' . $params['billplz[paid_at]'],
            'billplzpaid' . $params['billplz[paid]']
        ];

        return hash_hmac(algo: "sha256", data: implode('|', $data) , key: $this->client->getSignatureKey());
    }

    public function computeCallbackSignature(array $params)
    {
        $data = [
            'amount' . $params['amount'],
            'collection_id' . $params['collection_id'],
            'due_at' . $params['due_at'],
            'email' . $params['email'],
            'id' . $params['id'],
            'mobile' . $params['mobile'],
            'name' . $params['name'],
            'paid_amount' . $params['paid_amount'],
            'paid_at' . $params['paid_at'],
            'paid' . $params['paid'],
            'state' . $params['state'],
            'url' . $params['url'],
        ];

        return hash_hmac(algo: "sha256", data: implode('|', $data) , key: $this->client->getSignatureKey());
    }
}