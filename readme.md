# SimpleSMS

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
![Tests](https://github.com/Nerdbrygg/SimpleSMS/workflows/Tests/badge.svg)
[![StyleCI][ico-styleci]][link-styleci]

My first Laravel Package, uses Laravel's Http client to interact with [PSWin.com's](https://wiki.pswin.com/Gateway%20HTTP%20API.ashx) Simple HTTP API.

It offers the option to store messages in a database table, and also ability to encrypt/decrypt the message, for added security.

## Installation

Via Composer

``` bash
$ composer require nerdbrygg/simplesms
```

Configure these settings in your .env
```
SIMPLESMS_SOURCE=
SIMPLESMS_USERNAME=
SIMPLESMS_PASSWORD=
```

## Usage
By default the only middleware applied to the route is web. To secure this, you'd need to overwrite the route:
``` php
Route::middleware(['auth'])->group(function () {
    Route::post('sms/send', ['\Nerdbrygg\SimpleSMS\Controllers\SmsController', 'store'])->name('sms.store');
});
```

``` php
SimpleSMS::create(['message' => 'Hello World!', 'destination' => 'numbers [delimiters: ,;|.]', 'source' => 'Optional'])->send();
```

### Parameters

| Parameter     | Required | Default | Information              |
|---------------|:--------:|:-------:|--------------------------|
| message       | Yes      | None    | 804 characters max       |
| destination   | Yes      | None    | Separated by ,;|.        |
| source        | No       | SIMPLESMS_SOURCE | Number or text  |  


### Components

I've created a couple of simple bootstrap-themed components to get you up and running faster.

**Form**

``` html
<x-simplesms-form title="Some Title (optional)" :source="true (default: true)"></x-simplesms-form>
```

Will render a basic form for sending an sms.

Use `:source="false"` to stop source-field from rendering.

**Messages**

``` html
<x-simplesms-messages title="Some Title (optional)"></x-simplesms-messages>
```

Will render a basic display of all sent messages.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Nerdbrygg][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/nerdbrygg/simplesms.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/nerdbrygg/simplesms.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/281634119/shield

[link-packagist]: https://packagist.org/packages/nerdbrygg/simplesms
[link-downloads]: https://packagist.org/packages/nerdbrygg/simplesms
[link-styleci]: https://styleci.io/repos/281634119
[link-author]: https://github.com/nerdbrygg
[link-contributors]: ../../contributors
