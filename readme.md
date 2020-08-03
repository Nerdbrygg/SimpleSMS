# SimpleSMS

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
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

``` php
SimpleSMS::to(<areacode><number>)->message(<message>)->from(<optional sender number>)->send();
```

### Parameters

| Parameter | Required | Default |
|-----------|:--------:|---------|
| to()      | Yes      | None    |
| message() | Yes      | None    |
| from()    | No       | SIMPLESMS_SOURCE |


### Components

**Form**

``` html
<x-simplesms-form title="Some Title (optional)" :source="true (default: true)"></x-simplesms-form>
```

Will render a basic bootstrap-themed form for sending an sms.

Use `:source` parameter to stop source-field from rendering.

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
[ico-travis]: https://img.shields.io/travis/nerdbrygg/simplesms/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/281634119/shield

[link-packagist]: https://packagist.org/packages/nerdbrygg/simplesms
[link-downloads]: https://packagist.org/packages/nerdbrygg/simplesms
[link-travis]: https://travis-ci.org/nerdbrygg/simplesms
[link-styleci]: https://styleci.io/repos/281634119
[link-author]: https://github.com/nerdbrygg
[link-contributors]: ../../contributors
