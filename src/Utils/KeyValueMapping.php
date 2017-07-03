<?php

namespace Screamy\PriceImporter\Utils;

/**
 * Class KeyValueMapping
 * @package Screamy\PriceImporter\Utils
 */
class KeyValueMapping
{
    /**
     * KeyValueMapping constructor.
     * @param string $keyPath
     * @param string $valuePath
     */
    public function __construct($keyPath, $valuePath)
    {
        $this->keyPath = $keyPath;
        $this->valuePath = $valuePath;
    }

    /**
     * @var string
     */
    public $keyPath;

    /**
     * @var string
     */
    public $valuePath;
}
