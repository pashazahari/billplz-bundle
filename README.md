# billplz-bundle

This is a billplz payment gateway wrapper for Symfony application.


Installation
-------

`composer require pashazahari/billplz-bundle`


Requirement
-------

- PHP 8.0+
- Symfony 8.0+


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
            - { name: "", id: ""} # will use when create new bill
    live:
        api_key: "%env(BILLPLZ_API_KEY)%"
        signature_key: "%env(BILLPLZ_SIGNATURE_KEY)%"
        collection:
            - { name: "", id: ""}
```

Usage
-----

```php
/**
 * Note: if you have set 'enable_sandbox' to true, billplz will use 'sandbox' configuration only.
 */
function createPayment(BillplzInterface $billplz)
{
    /**
     * Assume you have set { name: "product", id: "ae12345"} in collection.
     * 
     * It will get the id from the given name, you don't have to do anything. 
     */
    $response = $billplz->createBill("product", "lorem@ipsum.com", null, "Lorem Ipsum", 100, "https://127.0.0.1/payment/success", "A new product", []);

    // your own logic here...
}
```
