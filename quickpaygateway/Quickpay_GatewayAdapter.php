<?php
namespace \Commerce\Gateways\Omnipay\Quickpay_GatewayAdapter;

use Commerce\Gateways\OffsiteGatewayAdapter;

class Quickpay_GatewayAdapter extends OffsiteGatewayAdapter
{
    public function handle()
    {
        return "Quickpay";
    }
}