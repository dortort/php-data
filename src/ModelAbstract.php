<?php

namespace Data;

abstract class ModelAbstract implements ModelInterface
{
    public function getAttributes($filter = null)
    {
        return [];
    }

    public function getRelationships($filter = null)
    {
        return [];
    }
}
