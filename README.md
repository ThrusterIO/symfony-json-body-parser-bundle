# SymfonyJsonBodyParserBundle Bundle

[![Latest Version](https://img.shields.io/github/release/ThrusterIO/symfony-json-body-parser-bundle.svg?style=flat-square)]
(https://github.com/ThrusterIO/symfony-json-body-parser-bundle/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)]
(LICENSE)
[![Build Status](https://img.shields.io/travis/ThrusterIO/symfony-json-body-parser-bundle.svg?style=flat-square)]
(https://travis-ci.org/ThrusterIO/symfony-json-body-parser-bundle)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ThrusterIO/symfony-json-body-parser-bundle.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/symfony-json-body-parser-bundle)
[![Quality Score](https://img.shields.io/scrutinizer/g/ThrusterIO/symfony-json-body-parser-bundle.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/symfony-json-body-parser-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/thruster/symfony-json-body-parser-bundle.svg?style=flat-square)]
(https://packagist.org/packages/thruster/symfony-json-body-parser-bundle)

[![Email](https://img.shields.io/badge/email-team@thruster.io-blue.svg?style=flat-square)]
(mailto:team@thruster.io)

The Thruster Symfony Json Body Parser Bundle. Parses JSON request body if request content type has word `json`.
You can disable parser for single route with route attribute `_ignore_json_body`


## Install

Via Composer

```bash
$ composer require thruster/symfony-json-body-parser-bundle
```

Enable Bundle

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Thruster\Bundle\SymfonyJsonBodyParserBundle(),
        // ...
    );
}
```

## Testing

```bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## License

Please see [License File](LICENSE) for more information.
