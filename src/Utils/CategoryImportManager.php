<?php

namespace Screamy\PriceImporter\Utils;

use Screamy\PriceImporter\Gateway\CategoryGatewayInterface as CategoryGateway;
use Screamy\PriceImporter\Mapper\CategoryIterator;
use Screamy\PriceImporter\Mapper\CategoryMapper;
use Screamy\PriceImporter\Parser\IteratorProviderInterface;

/**
 * Class CategoryImportManager
 * @package Screamy\PriceImporter\Utils
 */
class CategoryImportManager
{
    /**
     * @var IteratorProviderInterface
     */
    private $parser;

    /**
     * @var CategoryMapper
     */
    private $mapper;

    /**
     * @var CategoryGateway
     */
    private $categoryGateway;

    /**
     * CategoryImporter constructor.
     * @param IteratorProviderInterface $parser
     * @param CategoryMapper $mapper
     * @param CategoryGateway $categoryGateway
     */
    public function __construct(
        IteratorProviderInterface $parser,
        CategoryMapper $mapper,
        CategoryGateway $categoryGateway
    ) {
        $this->parser = $parser;
        $this->mapper = $mapper;
        $this->categoryGateway = $categoryGateway;
    }

    /**
     * @param string $filePath path to file with categories
     */
    public function importCategories($filePath)
    {
        $this->categoryGateway->emitCategories(new CategoryIterator(
            $this->parser->getIterator($filePath),
            $this->mapper
        ));
    }
}
