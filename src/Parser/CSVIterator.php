<?php

namespace Screamy\PriceImporter\Parser;

/**
 * Class CSVIterator
 * @package Screamy\PriceImporter\Parser
 */
class CSVIterator implements \Iterator
{
    /**
     * @var string
     */
    private $csvFilePath;

    /**
     * @var resource
     */
    private $fileResource;

    /**
     * @var array
     */
    private $currentLine;

    /**
     * @var string
     */
    private $fieldDelimiter = ',';

    /**
     * @var int
     */
    private $currentKey;

    /**
     * CSVIterator constructor.
     * @param $csvFilePath
     * @param $fieldDelimiter
     */
    public function __construct($csvFilePath, $fieldDelimiter)
    {
        $this->csvFilePath = $csvFilePath;
        $this->fieldDelimiter = $fieldDelimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if (null === $this->currentKey) {
            $this->next();
            $this->currentKey--;
        }
        return $this->currentLine;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        if (!$this->fileResource) {
            $this->fileResource = $this->getFileResource();
        }

        $this->currentLine = fgetcsv($this->fileResource, 1000, $this->fieldDelimiter);
        $this->currentKey++;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->currentKey;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        if ($this->currentLine === false) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->currentLine = null;
        $this->currentKey = null;
        $this->fileResource = null;
    }

    /**
     * @return resource
     * @throws \Exception
     */
    private function getFileResource()
    {
        if (!$this->fileResource) {
            $this->fileResource = fopen($this->csvFilePath, 'r');
        }

        if (!$this->fileResource) {
            throw new \Exception('Error opening file for reading');
        }

        return $this->fileResource;
    }

    public function __destruct()
    {
        if ($this->fileResource) {
            fclose($this->fileResource);
        }
    }
}
