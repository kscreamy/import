<?php

namespace Screamy\PriceImporter\Utils;

use Screamy\PriceImporter\Model\Product;

/**
 * Interface ProductImportManagerInterface
 * @package Screamy\PriceImporter\Utils
 */
interface ProductImportManagerInterface
{
    /**
     * @param Product $product
     * @return null
     */
    public function importProduct(Product $product);
}
