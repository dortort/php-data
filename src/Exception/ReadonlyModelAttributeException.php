<?php

namespace Data\Exception;

class ReadonlyModelAttributeException extends \Exception {
    public function __construct($attribute) {
        parent::__construct("Model attribute `{$attribute}` cannot be modified.");
    }
}