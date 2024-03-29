# Fork

A Laravel PHP library for processing code in the background.

This package uses a new ability in Laravel to serialize closures, which can then be executed in the command line in the background asynchronously.

## Install

Normal install via Composer.

### Register

In the old Laravel v5 way of doing things, you would edit the ``app/Console/Kernal.php`` file:

```php
protected $commands = [
    \Travis\Fork\Commands\ForkCommand::class,
];
```

In the newer Laravel v8+ way of doing things, you would edit your ``Provider.php`` file:

```php
public function boot()
{
    if ($this->app->runningInConsole()) {
        $this->commands([
            \Travis\Fork\Commands\ForkCommand::class,
        ]);
    }
}
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
