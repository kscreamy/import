<?php

namespace Screamy\PriceImporter\Mapper;

use Screamy\PriceImporter\Model\Product;
use Screamy\PriceImporter\Model\Product\ProductPrice;
use Screamy\PriceImporter\Model\Product\ProductProperty;
use Screamy\PriceImporter\Utils\KeyValueMapping;
use Screamy\PriceImporter\Utils\ProductMapping;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class ProductMapper
 * @package Screamy\PriceImporter\Mapper
 */
class ProductMapper
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    /**
     * @var ProductMapping
     */
    private $productMapping;

    /**
     * ProductMapper constructor.
     * @param ProductMapping $productMapping
     */
    public function __construct(ProductMapping $productMapping)
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->productMapping = $productMapping;
    }

    /**
     * @param array $entry
     * @return Product
     */
    public function mapToProduct(array $entry)
    {
        $product = new Product();
        $accessor = $this->accessor;
        if ($accessor->isReadable($entry, $this->productMapping->skuPath)) {
            $product->setSku($accessor->getValue($entry, $this->productMapping->skuPath));
        } else {
            throw new \DomainException('Sku field is not accessible');
        }

        if ($this->productMapping->idPath && $accessor->isReadable($entry, $this->productMapping->idPath)) {
            $product->setId($accessor->getValue($entry, $this->productMapping->idPath));
        }

        if ($this->productMapping->countPath && $accessor->isReadable($entry, $this->productMapping->countPath)) {
            $product->setCount($accessor->getValue($entry, $this->productMapping->countPath));
        }

        if ($this->productMapping->countPath && $accessor->isReadable($entry, $this->productMapping->categoryIdPath)) {
            $product->setCategoryId($accessor->getValue($entry, $this->productMapping->categoryIdPath));
        }

        $this->mapDescription($product, $entry);

        $this->mapPrices($product, $entry);

        $this->mapProperties($product, $entry);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $entry
     */
    private function mapDescription(Product $product, array $entry)
    {
        $accessor = $this->accessor;
        $mapping = $this->productMapping;

        if ($mapping->titlePath && $accessor->isReadable($entry, $mapping->titlePath)) {
            $product->setTitle($accessor->getValue($entry, $mapping->titlePath));
        }

        if ($mapping->descriptionPath && $accessor->isReadable($entry, $mapping->descriptionPath)) {
            $product->setDescription($accessor->getValue($entry, $mapping->descriptionPath));
        }
    }

    /**
     * @param Product $product
     * @param array $entry
     */
    private function mapPrices(Product $product, array $entry)
    {
        /**
         * @var array $keyValuePair
         */
        foreach ($this->getKeyValuePairs($entry, $this->productMapping->pricesPathCollection) as $keyValuePair) {
            if (is_null($keyValuePair['value'])) {
                return;
            }
            $product->addPrice(new ProductPrice($keyValuePair['value'], $keyValuePair['key']));
        }
    }

    /**
     * @param Product $product
     * @param array $entry
     */
    private function mapProperties(Product $product, array $entry)
    {
        /**
         * @var array $keyValuePair
         */
        foreach ($this->getKeyValuePairs($entry, $this->productMapping->propertiesPathCollection) as $keyValuePair) {
            if (is_null($keyValuePair['value'])) {
                return;
            }
            $product->addProperty(new ProductProperty($keyValuePair['key'], $keyValuePair['value']));
        }
    }

    /**
     * @param array $entry
     * @param array $keyValueMappings
     * @return array
     */
    private function getKeyValuePairs(array $entry, array $keyValueMappings)
    {
        $accessor = $this->accessor;

        $keyValuePairs = [];
        /**
         * @var KeyValueMapping $pricePathMapping
         */
        foreach ($keyValueMappings as $kvMapping) {
            $key = $value = null;
            if ($accessor->isReadable($entry, $kvMapping->valuePath)) {
                $value = $accessor->getValue($entry, $kvMapping->valuePath);
            }

            if ($kvMapping->keyPath && $accessor->isReadable($entry, $kvMapping->keyPath)) {
                $key = $accessor->getValue($entry, $kvMapping->keyPath);
            }

            $keyValuePairs[] = ['key' => $key, 'value' => $value];
        }
        return $keyValuePairs;
    }
}
