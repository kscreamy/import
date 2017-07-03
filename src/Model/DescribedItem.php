<?php

namespace Screamy\PriceImporter\Model;

/**
 * Class DescribedItem
 * @package Screamy\PriceImporter\Model
 */
trait DescribedItem
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var null|string
     */
    private $description;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
