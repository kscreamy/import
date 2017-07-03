<?php
namespace Screamy\PriceImporter\Model;

use Screamy\PriceImporter\Model\Product\ProductPrice;
use Screamy\PriceImporter\Model\Product\ProductProperty;

/**
 * Represents product
 *
 * Class Product
 * @package Screamy\PriceImporter\Model
 */
class Product
{
    use DescribedItem;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var int
     */
    private $id;

    /**
     * @var array of ProductPrice
     */
    private $prices = [];

    /**
     * width height depth color and other properties
     * @var array of ProductProperty
     */
    private $properties = [];

    /**
     * @var int
     */
    private $count;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param ProductProperty $property
     * @return $this
     */
    public function addProperty(ProductProperty $property)
    {
        $this->properties[] = $property;
        return $this;
    }

    /**
     * @param ProductPrice $price
     * @return $this
     */
    public function addPrice(ProductPrice $price)
    {
        $this->prices[] = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param $count
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }
}
