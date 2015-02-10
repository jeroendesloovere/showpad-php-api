# Showpad PHP wrapper class

[![Latest Stable Version](http://img.shields.io/packagist/v/jeroendesloovere/showpad-php-api.svg)](https://packagist.org/packages/jeroendesloovere/showpad-php-api)
[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/jeroendesloovere/showpad-php-api/blob/master/LICENSE)
[![Build Status](http://img.shields.io/travis/jeroendesloovere/showpad-php-api.svg)](https://travis-ci.org/jeroendesloovere/showpad-php-api)

This Showpad PHP wrapper class connects to the Showpad API.

## Usage

### Installation

``` json
{
    "require": {
        "jeroendesloovere/showpad-php-api": "1.0.*"
    }
}
```

> Adding this code in your `composer.json` file will get the [latest GitHub package](https://packagist.org/packages/jeroendesloovere/:package_name) using [Composer](https://getcomposer.org).

### Example

```
$showpadUsername = '';
$showpadApiKey   = ''; 

// define api
$api = new JeroenDesloovere\Showpad\Showpad(
    $showpadUsername,
    $showpadApiKey
);

// get all users
$items = $api->users->getAll();

// get all user groups
$items = $api->userGroups->getAll();
...
```
> [View all examples](/examples/example.php) or check [the Showpad class](/src/).


## Work in progress

[Jeroen Desloovere](https://github.com/jeroendesloovere) started this class to test if it is possible to make connection to the API of Showpad. It was possible and the base is set for this class. All functions in this class work, excepts the assets->create is untested (didn't worked offline). Every subClass has its getAll() function, other functions aren't defined yet.

## Documentation

The class is well documented inline. If you use a decent IDE you'll see that each method is documented with PHPDoc.

## Contributing

It would be great if you could help us improve this class. GitHub does a great job in managing collaboration by providing different tools, the only thing you need is a [GitHub](http://github.com) login.

* Use **Pull requests** to add or update code
* **Issues** for bug reporting or code discussions
* Or regarding documentation and how-to's, check out **Wiki**
More info on how to work with GitHub on help.github.com.

## License

The module is licensed under [MIT](./LICENSE). In short, this license allows you to do everything as long as the copyright statement stays present.