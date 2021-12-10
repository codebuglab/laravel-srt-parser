# ⚡⚡⚡ Laravel Srt Parser

Simple package to parse SubRip or srt file in Laravel

![Laravel Srt Parser](logo.png)

## Table of contents
- [Setup](#setup)
    - [Installation](#installation)
- [Instructions](#Instructions)
    - [Convert to Array](#convert-to-array)
- [License](#license)
## Setup
### Installation

To install this package through composer run the following command in the terminal

```bash
composer require codebuglab/laravel-srt-parser
```

## Instructions
- To use Srt Parser you have to include next facade file
```php
use CodeBugLab\SrtParser\Facades\SrtParser;
```


### Convert to Array
- This is how you can convert srt to array and read every subtitle details.
```php
$path = storage_path('app/Cars (2006).srt'); // file path

$srt = SrtParser::load($path)->toArray();
```
- Next is a simple array response you can get from this parser containing subtitle number, start time, stop time, duration of the words appearing in seconds and finally an array of text.
```php
Array
(
    [0] => Array
        (
            [number] => 1
            [startTime] => 00:00:38,365
            [stopTime] => 00:00:41,495
            [duration] => 3.1299998760223
            [text] => Array
                (
                    [0] => OK... Here we go. Focus.
                )

        )

    [1] => Array
        (
            [number] => 2
            [startTime] => 00:00:41,575
            [stopTime] => 00:00:44,935
            [duration] => 3.3599998950958
            [text] => Array
                (
                    [0] => Speed. I am speed.
                )

        )
    .
    .   
    .
)
```





## License

This package is a free software distributed under the terms of the MIT license.
