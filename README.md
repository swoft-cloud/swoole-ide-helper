# Swoole IDE Helper

[![Latest Stable Version](http://img.shields.io/packagist/v/swoft/swoole-ide-helper.svg)](https://packagist.org/packages/swoft/swoole-ide-helper)
[![For Swoole Version](https://img.shields.io/badge/swoole--version-v4.4.2-yellowgreen)](https://packagist.org/packages/swoft/swoole-ide-helper)

Add IDE helper for the **swoole** extension, forked from [swoole/ide-helper](https://github.com/swoole/ide-helper)

## Usage

The [swoft](https://github.com/swoft-cloud/swoft) use it as default.

You can add it by `composer`:

```bash
composer require --dev swoft/swoole-ide-helper
```

> `swoft/swoole-ide-helper` keep the same version of **swoole**

## Diff With swoole/ide-helper

跟源仓库稍微不同的是：给大部分方法参数添加了变量类型。

Old：

```php
public function send($fd, $send_data, $reactor_id=null){}
```

Now:

```php
public function send(int $fd, string $send_data, int $reactor_id=null){}
```

## Build

```bash
php dump.php
```
