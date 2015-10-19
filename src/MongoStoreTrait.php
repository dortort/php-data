<?php

namespace Data;

use Stringy\StaticStringy as Stringy;

trait MongoStoreTrait
{
    protected $_db;

    public function connect($server, $db, array $options = [])
    {
        $this->_db = (new \MongoClient($server, $options))->selectDB($db);

        return $this;
    }

    public function find($modelName, $id, $options = [])
    {
        // return $model;
    }

    public function query($modelName, $query)
    {
        // return $cursor;
    }

    protected function getCollection($modelName)
    {
        return $this->_db->selectCollection($modelName);
    }
}
