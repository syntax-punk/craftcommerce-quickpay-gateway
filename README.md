# Quickpay Gateway plugin for Craft CMS

Craft Commerce Quickpay Gateway plugin

![Screenshot](resources/screenshots/plugin_logo.png)

## Installation

To install QuickpayGateway plugin, follow these steps:

1. Download & unzip the file and place the `quickpaygateway` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/voogieJames/craftcommerce-quickpay-gateway.git` and place the `quickpaygateway` into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require craftcommerce-quickpay-gateway/quickpaygateway`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `quickpaygateway` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.
6. Make sure that you have `composer.phar`. Navigate to the `quickpaygateway` directory and run `composer.phar install` 

QuickpayGateway works on Craft 2.4.x and Craft 2.5.x.

## QuickpayGateway Overview

*   [QuickPay](https://quickpay.net/) is a Payment Service Provider that accept all common payment methods - credit cards, bank transfers, invoices, and more.
*   The Adapter utilizes Quickpay payment processor wrapped into Omnipay driver, which was forked from [NobrainerWeb](https://github.com/NobrainerWeb/omnipay-quickpay)
*   [Omnipay](https://omnipay.thephpleague.com/) is a payment processing library for PHP. 

###Enjoy!