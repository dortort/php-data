<?php

namespace Data\Tests;

class LazyLoadModelAbstractTest extends \PHPUnit_Framework_TestCase
{
    private $model;

    protected function setUp()
    {
        $this->model = $this->getMockBuilder('\\Data\\LazyLoadModelAbstract')
                            ->setConstructorArgs([new \Data\Store, 123])
                            ->setMethods(['getAttributes'])
                            ->getMockForAbstractClass();

        $this->model->expects($this->any())
                    ->method('getAttributes')
                    ->willReturn(['attr']);
    }

    public function testGetSetSimpleValue()
    {
        $this->assertEquals(null, $this->model->get('attr'));
    }

    protected function tearDown()
    {
        $this->model = null;
    }
}
