# billplz-bundle

This is a billplz payment gateway wrapper for Symfony application.


Installation
-------

`composer require fd6130/billplz-bundle`


Requirement
-------

- PHP7.4+
- Symfony 4.4+


Configuration
------

```
# .env
BILLPLZ_API_KEY=
BILLPLZ_SIGNATURE_KEY=
BILLPLZ_SANDBOX=
BILLPLZ_SANDBOX_API_KEY=
BILLPLZ_SANDBOX_SIGNATURE_KEY=
```

```yaml
# /config/packages/fd_billplz.yaml
fd_billplz:
    enable_sandbox: "%env(bool:BILLPLZ_SANDBOX)%" # true or false
    sandbox:
        api_key: "%env(BILLPLZ_SANDBOX_API_KEY)%"
        signature_key: "%env(BILLPLZ_SANDBOX_SIGNATURE_KEY)%"
        collection: # add your bill collection here
            - { name: "", id: ""} # "name" is the key name of the collection, "id" is the collection id
    live:
        api_key: "%env(BILLPLZ_API_KEY)%"
        signature_key: "%env(BILLPLZ_SIGNATURE_KEY)%"
        collection:
            - { name: "", id: ""}
```

Usage
-----

```php
function createPayment(BillplzInterface $billplz)
{
    $response = $billplz->createBill("collection_name", "lorem@ipsum.com", null, "Lorem Ipsum", 100, "https://127.0.0.1/payment/success", "A new product", []);

    // your own logic here...
}
```