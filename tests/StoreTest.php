<?php

namespace Data\Tests;

class StoreTest extends \PHPUnit_Framework_TestCase
{
    private $store;

    protected function setUp()
    {
        $this->store = $this->getMockBuilder('\\Data\\Store')
                            ->setMethods(['getAttributes', 'getRelationships'])
                            ->getMock();
    }

    public function testFetchRecord()
    {
        $this->assertEquals([], $this->store->fetchRecord('model', 123));
    }

    public function testCreateRecord()
    {
        $data = ['key' => 'value'];

        $this->assertEquals($data, $this->store->createRecord('model', 123, $data));
        $this->assertEquals($data, $this->store->fetchRecord('model', 123));
    }

    public function testUpdateRecord()
    {
        $data = ['key' => 'new-value'];

        $this->assertEquals($data, $this->store->updateRecord('model', 123, $data));
        $this->assertEquals($data, $this->store->fetchRecord('model', 123));
    }

    public function testDeleteRecord()
    {
        $this->assertEquals(true, $this->store->deleteRecord('model', 123));
        $this->assertEquals([], $this->store->fetchRecord('model', 123));
    }

    protected function tearDown()
    {
        $this->store = null;
    }
}
