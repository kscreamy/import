<?php

namespace Screamy\PriceImporter\Mapper;

use Screamy\PriceImporter\Model\Category;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class CategoryMapper
 * @package Screamy\PriceImporter\Mapper
 */
class CategoryMapper
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    /**
     * @var string
     */
    private $titlePath;

    /**
     * @var string
     */
    private $idPath;

    /**
     * @var string
     */
    private $parentIdPath;

    /**
     * CategoryMapper constructor.
     * @param string $titlePath
     * @param string $idPath
     * @param string $parentIdPath
     */
    public function __construct($titlePath, $idPath, $parentIdPath)
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->titlePath = $titlePath;
        $this->idPath = $idPath;
        $this->parentIdPath = $parentIdPath;
    }

    /**
     * @param array $entry
     * @return Category
     */
    public function mapToCategory(array $entry)
    {
        $title = $this->accessor->getValue($entry, $this->titlePath);
        $id = $this->accessor->getValue($entry, $this->idPath);
        $parentId = $this->accessor->getValue($entry, $this->parentIdPath);

        return new Category($id, $title, $parentId);
    }
}
