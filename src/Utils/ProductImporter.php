<?php

namespace Screamy\PriceImporter\Utils;

use Screamy\PriceImporter\Gateway\ProductGatewayInterface;
use Screamy\PriceImporter\Mapper\ProductIterator;
use Screamy\PriceImporter\Mapper\ProductMapper;
use Screamy\PriceImporter\Parser\IteratorProviderInterface;

/**
 * Class ProductImporter
 * @package Screamy\PriceImporter\Utils
 */
class ProductImporter
{
    /**
     * @var IteratorProviderInterface
     */
    private $parser;

    /**
     * @var ProductMapper
     */
    private $mapper;

    /**
     * @var ProductGatewayInterface
     */
    private $productGateway;

    /**
     * ProductImporter constructor.
     * @param IteratorProviderInterface $parser
     * @param ProductMapper $mapper
     * @param ProductGatewayInterface $productGateway
     */
    public function __construct(
        IteratorProviderInterface $parser,
        ProductMapper $mapper,
        ProductGatewayInterface $productGateway
    ) {
        $this->parser = $parser;
        $this->mapper = $mapper;
        $this->productGateway = $productGateway;
    }

    /**
     * @param string $productsFilePath path to file with products
     */
    public function importProducts($productsFilePath)
    {
        $this->productGateway->emitProducts(new ProductIterator(
            $this->parser->getIterator($productsFilePath),
            $this->mapper
        ));
    }
}
