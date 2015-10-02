<?php

namespace Data;

interface ModelInterface
{
    public function get($key);

    public function set($key, $value);

    public function getAttributes();

    public function getRelationships();
}
