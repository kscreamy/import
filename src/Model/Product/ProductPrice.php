<?php

namespace Screamy\PriceImporter\Model\Product;

use Screamy\PriceImporter\Model\DescribedItem;

/**
 * Class ProductPrice
 * @package Screamy\PriceImporter\Model\Product
 */
class ProductPrice
{
    use DescribedItem;

    /**
     * @var float
     */
    private $price;

    /**
     * ProductPrice constructor.
     * @param float $price
     * @param string $title price type
     */
    public function __construct($price, $title)
    {
        $this->price = $price;
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
