Behat Wiremock Extension
==============

A Behat Extension that manage over [Wiremock](http://wiremock.org) as a test for API calls.

Compatibility with Behat 3.0.*

This extension helps configure remote server, when we need to take control over thirds part services.
Over each scenario, the API will be automatically reset.

## Installing extension

The easiest way to install is by using [Composer](https://getcomposer.org):

```bash
$> curl -sS https://getcomposer.org/installer | php
$> php composer.phar require timitao/behat-wiremock-extension='1.0.*'
```

or composer.json

    "require": {
        "timitao/behat-wiremock-extension": "1.0.*"
    },

## Configuration

We can define services and map files by:

    extensions:
        Behat\WiremockExtension\ServiceContainer\Extension:
            wiremock:
                servers:
                      client1:
                            base_url: http://192.168.205.11
                            mappings_path: %paths.base%/data/mapping.json
                      client2:
                            base_url: http://192.168.205.12
                            mappings_path: %paths.base%/data/mapping2.json

## Example

Look at this [wiremock.feature](https://github.com/timiTao/BehatWiremockExtension/blob/master/features/wiremock.feature)

If you want this to test, will need recipe [Vagrant for BehatWiremockExtension](https://github.com/timiTao/VagrantBehatWiremockExtension) i tested over.
Then run tests on ``server`` node. The IP is hard coded in recipe for test purpose.

## Versioning

Staring version ``1.0.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]