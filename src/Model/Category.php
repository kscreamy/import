<?php
namespace Screamy\PriceImporter\Model;

/**
 * Represents product category
 *
 * Class Category
 * @package Screamy\PriceImporter\Model
 */
class Category
{
    use DescribedItem;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $parentId;

    /**
     * Category constructor.
     * @param $id
     * @param $title
     * @param int $parentId 1 means root parent (or no parent)
     */
    public function __construct($id, $title, $parentId = 1)
    {
        $this->id = $id;
        $this->title = $title;
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }
}
