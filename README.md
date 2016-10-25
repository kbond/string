# zenstruck/string

[![Build Status](http://img.shields.io/travis/kbond/string.svg?style=flat-square)](https://travis-ci.org/kbond/string)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/kbond/string.svg?style=flat-square)](https://scrutinizer-ci.com/g/kbond/string/)
[![StyleCI](https://styleci.io/repos/24108809/shield?branch=master)](https://styleci.io/repos/24108809)
[![Latest Stable Version](http://img.shields.io/packagist/v/zenstruck/string.svg?style=flat-square)](https://packagist.org/packages/zenstruck/string)
[![License](http://img.shields.io/packagist/l/zenstruck/string.svg?style=flat-square)](https://packagist.org/packages/zenstruck/string)

Various string utility functions for PHP.
A [Twig Extension](https://github.com/kbond/string-twig) is available.

## Installation

    composer require zenstruck/string

## Usage

### remove_whitespace

Replaces `&nbsp;` with a single space and converts multiple sequential spaces into a
single space.

```php
$ret = remove_whitespace("  foo &nbsp;   \n\n\n  \r  bar"); // $ret = "foo bar"
```

### null_trim

Similar to core "trim" but returns null instead of an empty string. When an array is
passed, all elements get processed recursively.

```php
$ret = null_trim(" foo  bar   "); // $ret = "foo bar"

$ret = null_trim("   "); // $ret = null

$ret = null_trim(array(" foo  bar   ", "   ")); // $ret = array("foo bar", null)

$ret = null_trim("foo / ", "/ "); // $ret = "foo"
```

### truncate_word

Truncates text to a length without breaking words (calls `remove_whitespace` before truncating).

```php
$ret = truncate_word("      foo       bar  baz", 10); // $ret = "foo bar..."
```
