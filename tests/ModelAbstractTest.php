<?php

namespace Data\Tests;

class ModelAbstractTest extends \PHPUnit_Framework_TestCase
{
    private $model;

    protected function setUp()
    {
        $this->model = $this->getMockBuilder('\\Data\\ModelAbstract')
                            ->setConstructorArgs([new \Data\Store])
                            ->setMethods(['getAttributes'])
                            ->getMockForAbstractClass();

        $this->model->expects($this->any())
                    ->method('getAttributes')
                    ->willReturn(['attr', 'attr-one', 'attr-two']);
    }

    public function testGetSetSimpleValue()
    {
        $this->assertEquals(null, $this->model->get('attr'));
        $this->assertEquals($this->model, $this->model->set('attr', 'val'));
        $this->assertEquals('val', $this->model->get('attr'));
    }

    public function testGetSetFakeAttribute()
    {
        $this->assertEquals($this->model, $this->model->set('fakeattr', 'val'));
        $this->assertEquals(null, $this->model->get('fakeattr'));
    }

    public function testGetSetNestedValue()
    {
        $this->assertEquals(null, $this->model->get('attr.nested'));
        $this->assertEquals($this->model, $this->model->set('attr.nested', 'val'));
        $this->assertEquals('val', $this->model->get('attr.nested'));
        $this->assertEquals(['nested' => 'val'], $this->model->get('attr'));
    }

    public function testGetSetFakeNestedAttribute()
    {
        $this->assertEquals($this->model, $this->model->set('fakeattr.nested', 'val'));
        $this->assertEquals(null, $this->model->get('fakeattr.nested'));
    }

    public function testGetSetMagicMethods()
    {
        $this->assertEquals(null, $this->model->get('attr-one'));
        $this->model->attrOne = 'val';
        $this->assertEquals('val', $this->model->get('attr-one'));

        $this->assertEquals(null, $this->model->attrTwo);
        $this->model->set('attr-two', 'val');
        $this->assertEquals('val', $this->model->attrTwo);
    }

    protected function tearDown()
    {
        $this->model = null;
    }
}
