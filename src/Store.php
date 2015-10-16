<?php

namespace Data;

use Ramsey\Uuid\Uuid;

class Store
{
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

    public function fetchRecord(/* $modelName, $id */)
    {
        return [];
    }

    public function createRecord($modelName, $id, array $data = [])
    {
        // return $data;
    }

    public function updateRecord($modelName, $id, array $data)
    {
        // return $data;
    }

    public function deleteRecord($modelName, $id)
    {
        // return true;
    }
}
