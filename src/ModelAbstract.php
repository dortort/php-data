<?php

namespace Data;

abstract class ModelAbstract implements ModelInterface
{
    protected $_data;

    protected $_dirty = [];

    public function isDirty()
    {
        return (0 < count($this->_dirty));
    }

    public function getAttributes($filter = null)
    {
        return [];
    }

    public function getRelationships($filter = null)
    {
        return [];
    }

    public function get($key)
    {

    }

    public function set($key, $value)
    {
        return $this;
    }

    public function __get($key)
    {
        $key = $this->inflectKey($key);
        $this->get($key);
    }

    public function __set($key, $value)
    {
        $key = $this->inflectKey($key);
        $this->set($key, $value);
    }

    protected function inflectKey($key)
    {
        return $key;
    }
}
