<?php

namespace Screamy\PriceImporter\Gateway;

use Screamy\PriceImporter\Mapper\CategoryIterator;

/**
 * Interface CategoryGatewayInterface
 * @package Screamy\PriceImporter\Gateway
 */
interface CategoryGatewayInterface
{
    /**
     * @param CategoryIterator $categories
     * @return null
     */
    public function emitCategories(CategoryIterator $categories);
}
