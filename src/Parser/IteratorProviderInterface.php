<?php

namespace Screamy\PriceImporter\Parser;

/**
 * Interface IteratorProviderInterface
 * @package Screamy\PriceImporter\Parser
 */
interface IteratorProviderInterface
{
    /**
     * @param string $entryFilePath path to file with entries
     * @return \Iterator iterator by entry objects (simple php arrays)
     */
    public function getIterator($entryFilePath);
}
