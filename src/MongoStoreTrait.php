<?php

namespace Data;

use Doctrine\Common\Inflector\Inflector;

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
        $collection = Inflector::pluralize($key);

        return $this->_db->selectCollection($collection);
    }
}
