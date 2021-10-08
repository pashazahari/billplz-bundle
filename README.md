# billplz-bundle

This is a billplz payment gateway wrapper for Symfony application.


Install
-------

`composer require fd6130/billplz-bundle`


Require
-------

- PHP7.4+
- Symfony 4.4+


Config
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
    fd_billplz:
    api_key: "%env(BILLPLZ_API_KEY)%"
    signature_key: "%env(BILLPLZ_SIGNATURE_KEY)%"
    sandbox: "%env(BILLPLZ_SANDBOX)%" # true or false
    sandbox_api_key: "%env(BILLPLZ_SANDBOX_API_KEY)%"
    sandbox_signature_key: "%env(BILLPLZ_SANDBOX_SIGNATURE_KEY)%"
```