<?php

namespace Fd\BillplzBundle\Service;

use Billplz\Client;
use Laravie\Codex\Contracts\Response;

class Billplz implements BillplzInterface
{
    private Client $client;

    private array $config;

    public function __construct
    (
        array $config
    )
    {
        $this->client = $config['enable_sandbox'] == false ? 
            Client::make($config['live']['api_key'], $config['live']['signature_key']) : 
            Client::make($config['sandbox']['api_key'], $config['sandbox']['signature_key'])->useSandbox();
        $this->config = $config;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getAllConfiguration(): array
    {
        return $this->config;
    }

    public function getCurrentConfiguration(): array
    {
        return $this->isSandbox() == false ? $this->config['live'] : $this->config['sandbox'];
    }

    public function isSandbox(): bool
    {
        return $this->config['enable_sandbox'];
    }

    public function getBillPaymentUrl(string $billId): string
    {
        return $this->isSandbox() == true ? sprintf('https://www.billplz-sandbox.com/bills/%s', $billId) : sprintf('https://www.billplz.com/bills/%s', $billId);
    }

    public function createBill
    (
        string $collectionKey,
        ?string $email = null,
        ?string $mobile = null,
        string $name,
        int|string $amount,
        string $callbackUrl,
        string $description,
        array $optional = []
    ) : Response
    {
        $collection = $this->getCurrentConfiguration()['collection'];

        $index = array_search($collectionKey, array_column($collection, 'name'));
        if($index === false)
        {
            throw new \LogicException(sprintf("Unable to find '%s' from the collection.", $collectionKey));
        }

        return $this->client->bill()
            ->create
            (
                $collection[$index]['id'], $email, $mobile, $name, \Duit\MYR::given($amount * 100), $callbackUrl, $description, $optional
            )
        ;
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