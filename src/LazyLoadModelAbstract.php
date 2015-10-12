<?php

namespace Data;

abstract class LazyLoadModelAbstract extends ModelAbstract
{
    protected function ensureData()
    {
        if (!is_array($this->_data)) {
            $this->hydrate();
        }

        return $this;
    }

    protected function hydrate()
    {
        $this->_data = $this->_store->fetchData($this->getModelName(), $this->_id);

        return $this;
    }
}
