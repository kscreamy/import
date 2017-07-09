<?php

namespace Screamy\PriceImporter\Utils;

use Screamy\PriceImporter\Model\Product;
use Screamy\PriceImporter\Exception\ProductNotFoundException;

/**
 * Interface ProductPricesImportManagerInterface
 * @package Screamy\PriceImporter\Utils
 */
interface ProductPricesImportManagerInterface
{
    /**
     * @param string $sku
     * @param array $prices
     * @throws ProductNotFoundException
     * @return null
     */
    public function importProductPrices($sku, array $prices);
}
