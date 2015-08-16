# megumi/wp-custom-login

[![Build Status](https://travis-ci.org/megumi-wp-composer/wp-custom-login.svg?branch=master)](https://travis-ci.org/megumi-wp-composer/wp-custom-login) [![Latest Stable Version](https://poser.pugx.org/megumi/wp-custom-login/v/stable.svg)](https://packagist.org/packages/megumi/wp-custom-login) [![Total Downloads](https://poser.pugx.org/megumi/wp-custom-login/downloads.svg)](https://packagist.org/packages/megumi/wp-custom-login) [![Latest Unstable Version](https://poser.pugx.org/megumi/wp-custom-login/v/unstable.svg)](https://packagist.org/packages/megumi/wp-custom-login) [![License](https://poser.pugx.org/megumi/wp-custom-login/license.svg)](https://packagist.org/packages/megumi/wp-custom-login)


## Installation

Create a composer.json in your project root.

```
{
    "require": {
        "megumi/wp-custom-login": "*"
    }
}
```

## Contributing

Clone this project.

```
$ git clone git@github.com:megumi-wp-composer/wp-custom-login.git
```

### Run testing

Initialize the testing environment locally:

(you'll need to already have mysql, svn and wget available)

```
$ bash bin/install-wp-tests.sh wordpress_test root '' localhost latest
```

Install phpunit.

```
$ composer install
```

The unit test files are in the `tests/` directory.

To run the unit tests, just execute:

```
$ phpunit
```

### Issue

[https://github.com/megumi-wp-composer/wp-custom-login/issues](https://github.com/megumi-wp-composer/wp-custom-login/issues)
