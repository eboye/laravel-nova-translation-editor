# Laravel Nova Translation Editor

This is the Laravel Nova Tool for managing translations. It's still work in progress.

You can view all the translations. Clicking on string you can edit it and save. The mutlilevel arrays in lang files are currently not working. So if you have idea on how to solve it. Please make a pull request.

It depends on [spatie/laravel-translation-loader](https://github.com/spatie/laravel-translation-loader)

So first you need to install it and set it up. Then add this Tool.

## Installation

```bash
composer require eboye/laravel-nova-translation-editor
```

### If you haven't already done, do publish Spatie/laravel-translation-loader migrations

```bash
php artisan vendor:publish --provider="Spatie\TranslationLoader\TranslationServiceProvider"
php artisan migrate
```

## Usage
### Publish Config
Publish config file and add any of the files you have in resource/lang/ folder
```bash
php artisan vendor:publish --provider="Eboye\LaravelNovaTranslationEditor\ToolServiceProvider"
```
config/trans_editor.php looks like this:

```php
<?php
return [
    'auth'
];
```

Just add any of the lang files you need.

### Add Nova tool
In your App\Providers\NovaServiceProvider.php, under tools, add

```php
new LaravelNovaTranslationEditor
```

and also the import of the Class
```php
use Eboye\LaravelNovaTranslationEditor\LaravelNovaTranslationEditor;
```

## Screenshots

![screenshot 1](https://raw.githubusercontent.com/eboye/laravel-nova-translation-editor/master/docs/screenshot_1.png)
