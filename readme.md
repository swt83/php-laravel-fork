# Fork

A Laravel PHP library for processing code in the background.

This package uses a new ability in Laravel to serialize closures, which can then be executed in the command line in the background asynchronously.

## Install

Normal install via Composer.

### Commands

Register the commands in your ``app/start/artisan.php`` file:

```php
Artisan::add(new Travis\Fork\Commands\ForkCommand);
```

## Usage

Just fork the code you want to run in the background:

```php
Fork::run(function() use($foobar)
{
    // do stuff
});
```

If you want to test for errors, you can run your code synchronously:

```php
Fork::test(function() use($foobar)
{
    // do stuff
});
```