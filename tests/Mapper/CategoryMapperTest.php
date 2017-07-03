<?php

namespace tests\Mapper;

use PHPUnit\Framework\TestCase;
use Screamy\PriceImporter\Mapper\CategoryMapper;

/**
 * Class CategoryMapperTest
 * @package tests\Mapper
 */
class CategoryMapperTest extends TestCase
{
    public function testMapper()
    {
        $mapper = new CategoryMapper('[title][text]', '[id]', '[parent_id]');

        $category = $mapper->mapToCategory(['title' => ['text' => 'title'], 'id' => 2, 'parent_id' => 1]);

        $this->assertEquals('title', $category->getTitle());
        $this->assertEquals(2, $category->getId());
        $this->assertEquals(1, $category->getParentId());
    }
}
