<?php

namespace Screamy\PriceImporter\Mapper;

use Screamy\PriceImporter\Model\Category;
use Traversable;

/**
 * Class CategoryIterator
 * @package Screamy\PriceImporter\Mapper
 */
class CategoryIterator extends \IteratorIterator
{
    /**
     * @var CategoryMapper
     */
    private $mapper;

    /**
     * CategoryMapperIterator constructor.
     * @param Traversable $iterator
     * @param CategoryMapper $mapper
     */
    public function __construct(Traversable $iterator, CategoryMapper $mapper)
    {
        parent::__construct($iterator);
        $this->mapper = $mapper;
    }

    /**
     * @return Category
     */
    public function current()
    {
        return $this->mapper->mapToCategory(parent::current());
    }
}
