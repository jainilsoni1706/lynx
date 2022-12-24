<?php

namespace Lynx\System\Database\SQL;

use Lynx\System\Database\Connection\Connect;
use Lynx\System\Exception\ApplicationException;

class DATASET {

    protected $table;
    protected $columns;
    protected $where;

    public static function table($table)
    {
        return new static($table);
    }

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function select($columns = '*')
    {
        $this->columns = $columns;
        return $this;
    }

    public function where($column, $operator = "=", $value)
    {
       try {
        $this->where = "WHERE {$column} {$operator} {$value}";
        return $this;
       } catch (\PDOException $e) {
           throw new ApplicationException($e->getMessage(),"Lynx/Framework/System/Exception/DatabaseException.php",500);
       }
    }

    public function orderBy($column, $order = "ASC")
    {
        $this->where .= " ORDER BY {$column} {$order}";
        return $this;
    }

    public function limit($limit)
    {
        $this->where .= " LIMIT {$limit}";
        return $this;
    }

    public function offset($offset)
    {
        $this->where .= " OFFSET {$offset}";
        return $this;
    }

    public function groupBy($column)
    {
        $this->where .= " GROUP BY {$column}";
        return $this;
    }

    public function min($column)
    {
        $this->columns = "MIN({$column})";
        return $this;
    }

    public function max($column)
    {
        $this->columns = "MAX({$column})";
        return $this;
    }

    public function avg($column)
    {
        $this->columns = "AVG({$column})";
        return $this;
    }

    public function sum($column)
    {
        $this->columns = "SUM({$column})";
        return $this;
    }

    public function count($column = "*")
    {
        $sql = "SELECT COUNT({$column}) FROM {$this->table} {$this->where}";
        $query = Connect::query($sql);
        if($query->rowCount() > 0){
            return $query->fetchAll();
        }else{
            return 0;
        }
    }

    public function lastInsertId()
    {
        return Connect::lastInsertId();
    }

    public function whereMonth($column, $operator = "=", $value)
    {
        $this->where = "WHERE MONTH({$column}) {$operator} {$value}";
        return $this;
    }

    public function whereYear($column, $operator = "=", $value)
    {
        $this->where = "WHERE YEAR({$column}) {$operator} {$value}";
        return $this;
    }


    public function whereDate($column, $operator = "=", $value)
    {
        $this->where = "WHERE DATE({$column}) {$operator} {$value}";
        return $this;
    }    

    public function join($table, $column1, $operator = "=", $column2)
    {
        $this->where .= " JOIN {$table} ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function leftJoin($table, $column1, $operator = "=", $column2)
    {
        $this->where .= " LEFT JOIN {$table} ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function rightJoin($table, $column1, $operator = "=", $column2)
    {
        $this->where .= " RIGHT JOIN {$table} ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function innerJoin($table, $column1, $operator = "=", $column2)
    {
        $this->where .= " INNER JOIN {$table} ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function fullJoin($table, $column1, $operator = "=", $column2)
    {
        $this->where .= " FULL JOIN {$table} ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function on($column1, $operator = "=", $column2)
    {
        $this->where .= " ON {$column1} {$operator} {$column2}";
        return $this;
    }

    public function get()
    {
        $sql = "SELECT {$this->columns} FROM {$this->table} {$this->where}";
        $query = Connect::query($sql);
        if($query->rowCount() > 0){
            return $query->fetchAll();
        }else{
            return 0;
        }
    }

    public function first()
    {
        $sql = "SELECT {$this->columns} FROM {$this->table} {$this->where}";
        $query = Connect::query($sql);
        if($query->rowCount() > 0){
            return $query->fetch(); 
        }else{
            return 0;
        }
    }

    public function insert($columns, $values)
    {
       try {
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $query = Connect::query($sql);
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
       } catch (\PDOException $e) {
           throw new ApplicationException($e->getMessage(),"Lynx/Framework/System/Exception/DatabaseException.php",500);
       }
    }

    public function update($columns, $values)
    {
        try {

            $sql = "UPDATE {$this->table} SET {$columns} = {$values} {$this->where}";
            $query = Connect::query($sql);
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $e) {
            throw new ApplicationException($e->getMessage(),"Lynx/Framework/System/Exception/DatabaseException.php",500);
        }
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM {$this->table} {$this->where}";
            $query = Connect::query($sql);
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $e) {
            throw new ApplicationException($e->getMessage(),"Lynx/Framework/System/Exception/DatabaseException.php",500);
        }
    }

}