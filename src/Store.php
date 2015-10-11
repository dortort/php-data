<?php

namespace Data;

use Ramsey\Uuid\Uuid;

class Store
{
    public function find($modelName, $id, $options)
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

    public function fetchData(/* $modelName, $id */)
    {
        return [];
    }
}
