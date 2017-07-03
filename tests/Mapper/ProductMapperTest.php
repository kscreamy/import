<?php

namespace tests\Mapper;

use PHPUnit\Framework\TestCase;
use Screamy\PriceImporter\Mapper\ProductMapper;
use Screamy\PriceImporter\Model\Product\ProductPrice;
use Screamy\PriceImporter\Model\Product\ProductProperty;
use Screamy\PriceImporter\Utils\KeyValueMapping;
use Screamy\PriceImporter\Utils\ProductMapping;

/**
 * Class ProductMapperTestMapperTest
 * @package tests\Mapper
 */
class ProductMapperTestMapperTest extends TestCase
{

    /**
     * @return array
     */
    public function productEntriesProvider()
    {
        //partial properties
        $productEntries[] = [
            [
                'sku' => 'sku_test1'
            ]
        ];

        //partial properties
        $productEntries[] = [
            [
                'sku' => 'sku_test1',
                'id' => 1,
                'cat_id' => 1,
                'count' => 5,
                'title' => 'titl',
                'description' => 'desc',
                'properties' => [
                    ['value' => 'val 0'],
                    ['value' => 'val 1']
                ]
            ]
        ];

        //partial prices
        $productEntries[] = [
            [
                'sku' => 'sku_test',
                'id' => 1,
                'count' => 5,
                'cat_id' => 1,
                'title' => 'titl',
                'description' => 'desc',
                'prices' => [
                    ['price' => 2],
                    ['price' => 3],
                    ['price' => 4],
                ]
            ]
        ];

        //full product
        $productEntries[] = [
            [
                'sku' => 'sku_test',
                'id' => 1,
                'count' => 5,
                'cat_id' => 1,
                'title' => 'titl',
                'description' => 'desc',
                'prices' => [
                    ['title' => 'title 0', 'price' => 2],
                    ['title' => 'title 1', 'price' => 3],
                ],
                'properties' => [
                    ['title' => 'prop 0', 'value' => 'val 0'],
                    ['title' => 'prop 1', 'value' => 'val 1']
                ]
            ]
        ];

        return $productEntries;
    }

    /**
     * @dataProvider productEntriesProvider
     * @param array $productEntry
     */
    public function testMapper(array $productEntry)
    {
        $mapping = new ProductMapping();

        $mapping->categoryIdPath = '[cat_id]';
        $mapping->skuPath = '[sku]';
        $mapping->idPath = '[id]';
        $mapping->countPath = '[count]';
        $mapping->titlePath = '[title]';
        $mapping->descriptionPath = '[description]';
        $mapping->pricesPathCollection = [
            new KeyValueMapping('[prices][0][title]', '[prices][0][price]'),
            new KeyValueMapping('[prices][1][title]', '[prices][1][price]'),
            new KeyValueMapping('[prices][2][title]', '[prices][2][price]')
        ];

        $mapping->propertiesPathCollection = [
            new KeyValueMapping('[properties][0][title]', '[properties][0][value]'),
            new KeyValueMapping('[properties][1][title]', '[properties][1][value]'),
            new KeyValueMapping('[properties][2][title]', '[properties][2][value]')
        ];

        $mapper = new ProductMapper($mapping);

        $product = $mapper->mapToProduct($productEntry);

        $this->assertEquals($productEntry['sku'], $product->getSku());

        if (isset($productEntry['id'])) {
            $this->assertEquals($productEntry['id'], $product->getId());
        }

        if (isset($productEntry['cat_id'])) {
            $this->assertEquals($productEntry['cat_id'], $product->getCategoryId());
        }
        if (isset($productEntry['count'])) {
            $this->assertEquals($productEntry['count'], $product->getCount());
        }
        if (isset($productEntry['title'])) {
            $this->assertEquals($productEntry['title'], $product->getTitle());
        }
        if (isset($productEntry['description'])) {
            $this->assertEquals($productEntry['description'], $product->getDescription());
        }

        /**
         * @var ProductPrice $price
         */
        foreach ($product->getPrices() as $i => $price) {
            if (isset($productEntry['prices'][$i]['title'])) {
                $this->assertEquals($productEntry['prices'][$i]['title'], $price->getTitle());
            }
            $this->assertEquals($productEntry['prices'][$i]['price'], $price->getPrice());
        }

        /**
         * @var ProductProperty $property
         */
        foreach ($product->getProperties() as $i => $property) {

            if (isset($productEntry['properties'][$i]['title'])) {
                $this->assertEquals($productEntry['properties'][$i]['title'], $property->getTitle());
            }
            $this->assertEquals($productEntry['properties'][$i]['value'], $property->getValue());
        }
    }
}
