<?php

namespace Screamy\PriceImporter\Gateway;

use Screamy\PriceImporter\Mapper\ProductIterator;

/**
 * Interface ProductGatewayInterface
 * @package Screamy\PriceImporter\Gateway
 */
interface ProductGatewayInterface
{
    /**
     * @param ProductIterator $products
     * @return null
     */
    public function emitProducts(ProductIterator $products);
}
