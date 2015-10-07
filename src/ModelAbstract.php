<?php

namespace Data;

use Symfony\Component\PropertyAccess\PropertyAccess;

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
        return $this->getDataValue($key);
    }

    public function set($key, $value)
    {
        if (in_array($this->getRootKey($key), $this->getAttributes())) {
            $this->setDataValue($key, $value);
        }

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

    protected function inflectAccessorPath($path)
    {
        return '[' . str_replace('.', '][', $path) . ']';
    }

    protected function getRootKey($key)
    {
        return preg_replace('/\..*$/', '', $key);
    }

    protected function getDataValue($key)
    {
        $accessor = self::getPropertyAccessor();

        $path = $this->inflectAccessorPath($key);

        if ($accessor->isReadable($this->_dirty, $path)) {
            return $accessor->getValue($this->_dirty, $path);
        }

        return $accessor->getValue($this->_data, $path);
    }

    protected function setDataValue($key, $value)
    {
        $accessor = self::getPropertyAccessor();

        $path = $this->inflectAccessorPath($key);

        $accessor->setValue($this->_dirty, $path, $value);

        return $this;
    }

    protected static function getPropertyAccessor()
    {
        static $accessor;

        if (!isset($accessor)) {
            $accessor = PropertyAccess::createPropertyAccessor();
        }

        return $accessor;
    }
}
