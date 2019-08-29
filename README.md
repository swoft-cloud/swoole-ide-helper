# Swoole IDE Helper

[![Latest Stable Version](http://img.shields.io/packagist/v/swoft/swoole-ide-helper.svg)](https://packagist.org/packages/swoft/swoole-ide-helper)

Add IDE helper for **swoole** extension, forked from [swoole/ide-helper](https://github.com/swoole/ide-helper)

## Usage

The [swoft](https://github.com/swoft-cloud/swoft) use it as default.

you can add it by `composer`:

```bash
composer require --dev swoft/swoole-ide-helper
```

> `swoft/swoole-ide-helper` keep the same version of **swoole**

## Diff With swoole/ide-helper

跟源仓库稍微不同的是：给大部分方法参数添加了变量类型。

eg, old：

```php
public function send($fd, $send_data, $reactor_id=null){}
```

now:

```php
public function send(int $fd, string $send_data, int $reactor_id=null){}
```

## Build

```bash
php dump.php
```
