<?php

namespace Data;

use Ramsey\Uuid\Uuid;

class Store
{
    protected $_data = [];

    public function find($modelName, $id, $options = [])
    {
        // return $model;
    }

    public function query($modelName, $query)
    {
        // return $cursor;
    }

    public function generateIdForModel(/* $modelName, $data */)
    {
        return Uuid::uuid4()->toString();
    }

    public function fetchRecord($modelName, $id)
    {
        if (isset($this->_data[$modelName][$id])) {
            return $this->_data[$modelName][$id];
        }

        return [];
    }

    public function createRecord($modelName, $id, array $data = [])
    {
        $this->_data[$modelName][$id] = $data;

        return $data;
    }

    public function updateRecord($modelName, $id, array $data)
    {
        $this->_data[$modelName][$id] = $data;

        return $data;
    }

    public function deleteRecord($modelName, $id)
    {
        unset($this->_data[$modelName][$id]);

        return true;
    }
}
