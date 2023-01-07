<?php

namespace Lynx\System\Model;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Database\Connection\Connect;
use Lynx\System\Database\SQL\DATASET;

class Model {

    protected static $table;
    protected static $select = "*";
    protected static $where;
    protected static $query;

    public static function all()
    {
        $table = self::setTable(new static);
        $query = "SELECT * FROM $table";

        $msc = microtime(true);
        $result = DATASET::query($query);
        $msc = microtime(true)-$msc;

        return collect([$result])->setEloquent($table, new static, $msc);
    }

    public static function select()
    {
        if (func_num_args() == 0) {
            self::$select = "*";
        } else {
            $args = func_get_args();
            self::$select = implode(',', $args);
        }

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
                self::$where .= " AND $column $operator '$value'";
            } else {
                self::$where = "WHERE $column $operator '$value'";
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
        $table = self::setTable(new static);
        $query = "SELECT ".self::$select." FROM $table ".self::$where;

        $msc = microtime(true);
        $result = DATASET::query($query);
        $msc = microtime(true)-$msc;
        self::$query = $query;
        
        return collect($result)->setEloquent($table, new static, $msc);
    }

    public static function whereIn($column, $values = [])
    {
        $values = array_map(function($value) {
            return "'$value'";
        }, $values);

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
            self::$where .= " AND $column BETWEEN '" . $values[0] . "' AND '" . $values[1]."'";
        } else {
            self::$where = "WHERE $column BETWEEN '" . $values[0] . "' AND '" . $values[1]."'";
        }

        return new static;
    }
    
    public static function setTable($temp)
    {
        $temp = $temp;
        $class = get_class($temp);
        $class = explode('\\',$class);
        $class = strtolower(end($class));

        if (Connect::tableExists($class)) {
            return $class;
        } else {
            if (Connect::tableExists($temp::$table)) {
                return $temp::$table;
            } else {
                return new ApplicationException("Table $class does not exist", "Lynx/Framework/System/Exception/DatabaseException.php", 500);   
            }
        }
    }

    public static function create($data = [])
    {
        $table = self::setTable(new static);

        if (is_array($data)) {
            if (isset($data[0])) {
                $columns = array_keys($data[0]);
                $columns = implode(',', $columns);
                $values = [];
                foreach ($data as $key => $value) {
                    $values[] = "('" . implode("','", $value) . "')";
                }
                $values = implode(',', $values);
            } else {
                $columns = array_keys($data);
                $columns = implode(',', $columns);
                $values = "('" . implode("','", $data) . "')";
            }

            $query = "INSERT INTO $table ($columns) VALUES $values";

            $msc = microtime(true);
            $result = DATASET::multiQuery($query);
            $msc = microtime(true)-$msc;
    
            return array("table" => $table, "Eloquent" => new static, "executionTime" =>$msc);

        } else {
            return new ApplicationException("Invalid arguments passed.", "Lynx/Framework/System/Exception/DatabaseException.php", 500);   
        }
    }

    public static function delete()
    {
        $table = self::setTable(new static);
        $query = "DELETE FROM $table ".self::$where;

        $msc = microtime(true);
        $result = DATASET::query($query);
        $msc = microtime(true)-$msc;

        return array("table" => $table, "Eloquent" => new static, "executionTime" =>$msc);
    }
    
 
}