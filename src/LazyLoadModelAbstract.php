<?php

namespace Data;

abstract class LazyLoadModelAbstract extends ModelAbstract
{
    protected function hydrate()
    {
        $this->_data = $this->_store->fetchData($this->getModelName(), $this->_id);

        return $this;
    }
}
