<?php

namespace Lynx\System\Model;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Database\SQL\DATASET;

class Model {
 
    public static function all()
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table}";
        $result = DATASET::query($sql);
        return $result;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __call($method, $args)
    {
        return new ApplicationException("Method {$method} does not exist in " . get_class($this));
    }

    public static function first()
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table} LIMIT 1";
        $result = DATASET::query($sql);
        return $result[0];
    }
 
}