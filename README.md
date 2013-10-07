# Showpad PHP wrapper class

This Showpad PHP wrapper class connects to the Showpad API.

## Work in progress

[Jeroen Desloovere](https://github.com/deslooverej) started this class to test if it is possible to make connection to the API of Showpad. It was possible and the base is set for this class. All functions in this class work, excepts the assets->create is untested (didn't worked offline). Every subClass has its getAll() function, other functions aren't defined yet.

## Example

```
// define api
$api = new Showpad($username, $apiKey);

// get all users
$items = $api->users->getAll();

// get all user groups
//$items = $api->userGroups->getAll();
```
[Check all possible functions](./tests/index.php)

## Documentation

The class is well documented inline. If you use a decent IDE you'll see that each method is documented with PHPDoc.

## Contributing

It would be great if you could help us improve this class. GitHub does a great job in managing collaboration by providing different tools, the only thing you need is a [GitHub](http://github.com) login.

* Use **Pull requests** to add or update code
* **Issues** for bug reporting or code discussions
* Or regarding documentation and how-to's, check out **Wiki**
More info on how to work with GitHub on help.github.com.

## License

The module is licensed under [MIT](./LICENSE.md). In short, this license allows you to do everything as long as the copyright statement stays present.