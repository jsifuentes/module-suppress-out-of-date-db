# Sifuen_SuppressOutOfDateDb

This Magento 2 module hides the "Please upgrade your database" message.

https://sifuen.com/magento-2/how-to-hide-the-please-upgrade-your-database-exception-message/

The exception message is moved to the system messages tray in the Backend.
 
![i1](https://i.imgur.com/9PECODm.png)

Clicking through the link in the system tray sends you to a list of modules that are out of date.

![1](https://i.imgur.com/LNqbhhQ.png)

## Installation

You can install this module by using [Composer](https://getcomposer.org).

```bash
composer require sifuen/module-suppress-out-of-date-db
```

You can also download this repository and place the code into `app/code/Sifuen/`.

Finally, run `setup:upgrade` to install the module.

```bash
php bin/magento setup:upgrade
```

## How to use

To hide the error message, simply run the following command in your terminal.

```bash
php bin/magento dev:db:toggle-out-of-date-error
```

When your modules are out of date, you will be notified in the admin system messages.

## Contributing

Feel free to create a pull request if you'd like to improve this module.