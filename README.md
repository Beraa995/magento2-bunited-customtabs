# Magento 2 Bunited Custom Product Tabs

This module provides functionality to add product tabs on product detail page through magento backed. <br />

## Installation

Install the latest version with

```
$ composer require bunited/customtabs
```

Install module

```
$ php bin/magento setup:upgrade
$ php bin/magento setup:di:compile
```

Don't forget to clear cache
```
$ php bin/magento cache:flush
$ php bin/magento cache:clean
```

## Examples

#### Admin system configuration <br />

Hide tabs options <br />
Set order to default magento tab

<img src="https://i.imgur.com/wiu3uP8.png" alt="system conf" width="1300px">

#### Add your own tabs

<img src="https://i.imgur.com/EWEm516.png" alt="add tabs" width="1300px">
