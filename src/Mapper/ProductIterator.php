<?php

namespace Screamy\PriceImporter\Mapper;

use Screamy\PriceImporter\Model\Product;
use Traversable;

/**
 * Class ProductIterator
 * @package Screamy\PriceImporter\Mapper
 */
class ProductIterator extends \IteratorIterator
{
    /**
     * @var ProductMapper
     */
    private $mapper;

    /**
     * ProductIterator constructor.
     * @param Traversable $iterator
     * @param ProductMapper $mapper
     */
    public function __construct(Traversable $iterator, ProductMapper $mapper)
    {
        parent::__construct($iterator);
        $this->mapper = $mapper;
    }

    /**
     * @return Product
     */
    public function current()
    {
        return $this->mapper->mapToProduct(parent::current());
    }
}
