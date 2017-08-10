<?php
namespace Commerce\Gateways\Omnipay;

use Commerce\Gateways\OffsiteGatewayAdapter;

class Quickpay_GatewayAdapter extends OffsiteGatewayAdapter
{
    public function handle()
    {
        return "Quickpay_Ecommerce";
    }
}