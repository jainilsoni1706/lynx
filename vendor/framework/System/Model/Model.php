<?php

namespace Lynx\System\Model;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Database\SQL\DATASET;
use Lynx\System\Set\Set;

class Model {
 
    public static function all()
    {
        $model = new static;
        $sql = "SELECT * FROM {$model->table}";
        $result = DATASET::query($sql);

        $msc = microtime(true);
        $result = DATASET::query($sql);
        $msc = microtime(true)-$msc;
        $result['model'] = $model;
        $result['executionTime'] = $msc.'s';

        return Set::collect([$result]);
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

        $msc = microtime(true);
        $result = DATASET::query($sql);
        $msc = microtime(true)-$msc;
        $result['model'] = $model;
        $result['executionTime'] = $msc.'s';

        return Set::collect([$result]);
    }

    public static function find()
    {
        $model = new static;

        $args = func_get_args();

        if (count($args) == 1) {
            $sql = "SELECT * FROM {$model->table} WHERE id = '{$args[0]}'";
        } else if (count($args) == 2) {
            $sql = "SELECT * FROM {$model->table} WHERE {$args[0]} = '{$args[1]}'";
        } else {
            return new ApplicationException("Method find() expects 1 or 2 arguments, " . count($args) . " given");
        }

        $msc = microtime(true);
        $result = DATASET::query($sql);
        $msc = microtime(true)-$msc;
        $result['model'] = $model;
        $result['executionTime'] = $msc.'s';

        return Set::collect([$result]);
    }
 
}