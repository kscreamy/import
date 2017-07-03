<?php

namespace Screamy\PriceImporter\Model\Product;

use Screamy\PriceImporter\Model\DescribedItem;

/**
 * Class ProductProperty
 * @package Screamy\PriceImporter\Model
 */
class ProductProperty
{
    use DescribedItem;

    /**
     * @var string
     */
    private $value;

    /**
     * ProductProperty constructor.
     * @param string $title
     * @param string $value
     */
    public function __construct($title, $value)
    {
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
