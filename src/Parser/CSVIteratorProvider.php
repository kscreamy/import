<?php

namespace Screamy\PriceImporter\Parser;

/**
 * Class CSVIteratorProvider
 * @package Screamy\PriceImporter\Parser
 */
class CSVIteratorProvider implements IteratorProviderInterface
{
    /**
     * @var string
     */
    private $fieldDelimiter;

    /**
     * CSVParser constructor.
     * @param string $fieldDelimiter
     */
    public function __construct($fieldDelimiter)
    {
        $this->fieldDelimiter = $fieldDelimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator($entryFilePath)
    {
        return new CSVIterator($entryFilePath, $this->fieldDelimiter);
    }
}
