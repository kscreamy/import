<?php

namespace tests\Parser;

use PHPUnit\Framework\TestCase;
use Screamy\PriceImporter\Parser\CSVIteratorProvider;

class CSVParserTest extends TestCase
{
    public function testIterator()
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'imp_tests');

        $tmpFileResource = fopen($tmpFile, 'w');
        $csvLines = [
            [2, "Cat1\"\"", 1],
            [3, 'Cat 2"', 2],
            [4, "Cat3''", 2]
        ];
        foreach ($csvLines as $line) {
            fputcsv($tmpFileResource, $line, ';');
        }

        fclose($tmpFileResource);


        $parser = new CSVIteratorProvider(';');
        $iterator = $parser->getIterator($tmpFile);
        foreach ($iterator as $i => $entry) {
            $this->assertEquals($csvLines[$i], $entry);
        }
    }
}
