# Changelog

All notable changes to `SimpleSMS` will be documented in this file.

## Version 0.3.0
I decided to switch APIs because of the number of POST-requests needed to send multiple messages. With the XML API you can send multiple messages with a single POST-request.
Switching APIs basicly resulted in a total rework of the package. But I think I've got everything working now.

### Added
* XMLParser for converting arrays to XML
    - This is probably subject to change since it's mainly created for only one provider.
* NumberParser for simple splitting of numbers and appending country codes.
* Github Actions

### Removed
- TravisCI
- Alot of redundant code

## Version 0.2.3

### Added
- Blade Components: Form and Messages.
- Optional source-parameter on Form component.
- Composer script "test", just so that the readme is correct.

### Removed 
- create.blade.php view.
- Route::get('sms') from routes.
- Controller method create().

## Version 0.2.1

### Added
- user_id to fillable field in SMS class.
- Ability to save user_id to database.

## Version 0.2

### Added
- Nullable user_id field, for optional relationships.
- License
- Some ReadMe stuff.
- Fixed Travis CI
- Fixed StyleCI

## Version 0.1

### Added
- Everything
