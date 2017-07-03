<?php

namespace Screamy\PriceImporter\Utils;

/**
 * Class ProductMapping
 * @package Screamy\PriceImporter\Utils
 */
class ProductMapping
{
    /**
     * @var string
     */
    public $titlePath;

    /**
     * @var string
     */
    public $descriptionPath;

    /**
     * @var string
     */
    public $idPath;

    /**
     * @var string
     */
    public $skuPath;

    /**
     * @var array
     * array of KeyValueMapping
     */
    public $pricesPathCollection = [];

    /**
     * @var array
     * array of KeyValueMapping
     */
    public $propertiesPathCollection = [];

    /**
     * @var string
     */
    public $countPath;

    /**
     * @var string
     */
    public $categoryIdPath;
}
