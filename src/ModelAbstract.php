<?php

namespace Data;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Stringy\StaticStringy as Stringy;

abstract class ModelAbstract implements ModelInterface
{
    protected $_store;

    protected $_id;

    protected $_data;

    protected $_dirty = [];

    public function __construct(Store $store, $id = null, array $data = null)
    {
        $this->_store = $store;

        if (null === $id) {
            $this->_id = $store->generateIdForModel($this->getModelName(), $data);
            $this->_data = [];
        } else {
            $this->_id = $id;
            $this->_data = $data;
        }
    }

    public function getModelName()
    {
        return substr(strrchr(get_class($this), '\\'), 1);
    }

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

    public function get($attribute)
    {
        return $this->getDataValue($attribute);
    }

    public function set($attribute, $value)
    {
        if (in_array($this->getRootAttribute($attribute), $this->getAttributes())) {
            $this->setDataValue($attribute, $value);
        }

        return $this;
    }

    public function __get($key)
    {
        $attribute = $this->inflectKey($key);
        return $this->get($attribute);
    }

    public function __set($key, $value)
    {
        $attribute = $this->inflectKey($key);
        $this->set($attribute, $value);
    }

    protected function inflectKey($key)
    {
        return (string) Stringy::dasherize($key);
    }

    protected function inflectAccessorPath($path)
    {
        return '[' . str_replace('.', '][', $path) . ']';
    }

    protected function getRootAttribute($attribute)
    {
        return preg_replace('/\..*$/', '', $attribute);
    }

    protected function getDataValue($attribute)
    {
        $accessor = self::getPropertyAccessor();

        $path = $this->inflectAccessorPath($attribute);

        if ($accessor->isReadable($this->_dirty, $path)) {
            return $accessor->getValue($this->_dirty, $path);
        }

        return $accessor->getValue($this->_data, $path);
    }

    protected function setDataValue($attribute, $value)
    {
        $accessor = self::getPropertyAccessor();

        $path = $this->inflectAccessorPath($attribute);

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
