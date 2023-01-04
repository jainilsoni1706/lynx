<?php

namespace Lynx\System\Model;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Database\SQL\DATASET;

class Model {

    protected static $table;
    protected static $select;
    protected static $where;
    protected static $query;

    public static function all()
    {
        $model = new static;
        $table = $model::$table;
        $query = "SELECT * FROM $table";

        $msc = microtime(true);
        $result = DATASET::query($query);
        $msc = microtime(true)-$msc;

        return collect([$result]);
    }

    public static function select()
    {
        $args = func_get_args();
        $args = implode(',', $args);
        self::$select = $args;

        return new static;
    }

    public static function where()
    {
        try {

            $args = func_get_args();

            if (count($args) > 3 && count($args) < 2) {
                return new ApplicationException("Invalid number of arguments passed to where method", "Lynx/Framework/System/Exception/DatabaseException.php", 500);
            }

            if (count($args) == 3) {
                $column = $args[0];
                $operator = $args[1];
                $value = $args[2];
            } else {
                $column = $args[0];
                $operator = "=";
                $value = $args[1];
            }

            if (isset(self::$where)) {
                self::$where .= " AND $column $operator $value";
            } else {
                self::$where = "WHERE $column $operator $value";
            }

            return new static;

        } catch (ApplicationException $e) {
            echo $e->getMessage();
        }
    } 

    public static function orderBy($column, $order = "ASC")
    {
        self::$where .= " ORDER BY {$column} {$order}";
        return new static;
    }

    public static function limit($limit)
    {
        self::$where .= " LIMIT {$limit}";
        return new static;
    }

    public static function offset($offset)
    {
        self::$where .= " OFFSET {$offset}";
        return new static;
    }

    public static function get()
    {
        $model = new static;
        $table = $model::$table;
        $query = "SELECT ".self::$select." FROM $table ".self::$where;

        $msc = microtime(true);
        $result = DATASET::query($query);
        $msc = microtime(true)-$msc;
        self::$query = $query;

        return collect([$result]);
    }

    public static function whereIn($column, $values = [])
    {
        $values = implode(',', $values);

        if (isset(self::$where)) {
            self::$where .= " AND $column IN ($values)";
        } else {
            self::$where = "WHERE $column IN ($values)";
        }

        return new static;
    }

    public static function whereBetween($column, $values = [])
    {
        if (isset(self::$where)) {
            self::$where .= " AND $column BETWEEN " . $values[0] . " AND " . $values[1];
        } else {
            self::$where = "WHERE $column BETWEEN " . $values[0] . " AND " . $values[1];
        }

        return new static;
    }
    
    public static function toSql()
    {
        return self::$query;
    }
 
}