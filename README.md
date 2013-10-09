Skpd\Bootstrap, v0.1
=====================

[![Latest Stable Version](https://poser.pugx.org/Skpd/Bootstrap/v/stable.png)](https://packagist.org/packages/Skpd/Bootstrap)
[![Total Downloads](https://poser.pugx.org/Skpd/Bootstrap/downloads.png)](https://packagist.org/packages/Skpd/Bootstrap)

Introduction
------------

__Skpd\Bootstrap__ is a module for Zend Framework 2, for easy integration of the [Twitter Bootstrap v3.*](https://github.com/twbs/bootstrap). 

Demonstration
-----------------------

Example files located at *examples* directory. You can run it with PHP built-in server:
```
php -S 127.0.0.1:8080 -t vendor/skpd/bootstrap/examples/
```


Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (2.2.*)
* [Twitter Bootstrap](https://github.com/twbs/bootstrap) (v3.*)

Installation
------------

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "skpd/bootstrap": "dev-master"
    }
    ```

#### Post installation

1. Enable it in your `application.config.php` file.

    ```php
    return array(
        'modules' => array(
            'Skpd\Bootstrap',
            // ...
        ),
    );
    ```

#### Roadmap

- [x] Default elements
- [x] Form Types (inline, horizontal, default) 
- [x] Help blocks
- [ ] Alerts with the *Flash Messenger* plugin
