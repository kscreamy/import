<?php

namespace Screamy\PriceImporter\Gateway;

/**
 * Interface CategoryGatewayInterface
 * @package Screamy\PriceImporter\Gateway
 */
interface CategoryGatewayInterface
{
    /**
     * @param array $categories
     * @return null
     */
    public function emitCategories(array $categories);
}
