<?php

namespace Lynx\System\Set;

use Lynx\System\Exception\ApplicationException;

class Set {
    
    public static $set = [];
    public $setType = '';

    public function __construct($set = [])
    {
        self::$set = $set;
        $this->original = $set;
        $this->type($set);
    }

    public static function collect($set = [])
    {
        return new static($set);
    }

    public function type($set)
    {
        $set = $this->original;
        
        if(is_array($set) && !empty($set)){
            $this->setType = 'array';
            $this->arrayType = $this->arrayType();
        }else if(is_object($set) && !empty($set)){
            $this->setType = 'object';
        }else{
            return new ApplicationException("Set is empty or not valid","Lynx/System/Exception/SetException.php");
        }
    }

    public function isMultiArray()
    {
        $array = $this->original;

        $rv = array_filter($array,'is_array');
        if(count($rv)>0) return 1;
        return 0;
    }

    public function arrayType()
    {
        if (array_keys($this->original) !== range(0, count($this->original) - 1)) {
            return "associative";
        } else {
            return "index";
        }
    }

    public function all()
    {
        return $this->original;   
    }

    public function smallest($key = null)
    {
        if ($this->setType === 'array') {

            if ($key !== null) {
                if (array_key_exists($key, $this->original)) {
                    $smallestNo = 0;
                    $isFirst = true;
        
                    for($i=0; $i<count($this->original); $i++) {
                        if($isFirst) {
                            $smallestNo = $this->original[$i]->$key;
                            $isFirst = false;
                        }
                        if ($this->original[$i]->$key < $smallestNo) {
                            $smallestNo = $this->original[$i]->$key;
                        }
                    }
        
                    return $smallestNo;
                } else {
                    return new ApplicationException("Key {$key} does not exists in set","Lynx/System/Exception/SetException.php");
                }
            } else {
                
                if ($this->arrayType == 'associative') {

                    $smallestNo = 0;
                    $isFirst = true;

                    foreach($this->original as $key => $value) {
                        if($isFirst) {
                            $smallestNo = $value;
                            $isFirst = false;
                        }
                        if ($value < $smallestNo) {
                            $smallestNo = $value;
                        }
                    }
        
                    return $smallestNo;

                } else if($this->arrayType === 'index') {
                    $smallestNo = 0;
                    $isFirst = true;
        
                    for($i=0; $i<count($this->original); $i++) {
                        if($isFirst) {
                            $smallestNo = $this->original[$i];
                            $isFirst = false;
                        }
                        if ($this->original[$i] < $smallestNo) {
                            $smallestNo = $this->original[$i];
                        }
                    }
        
                    return $smallestNo;
                } else {
                    return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
                }

            }

            if ($this->arrayType == 'associative') {

            } else if($this->arrayType === 'index') {

            } else {
                return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
            }
        } else {
            return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
        }
    }
    
    public function biggest($key = null)
    {
        if ($this->setType === 'array') {

            if ($key !== null) {
                if (array_key_exists($key, $this->original)) {
                    $biggestNo = 0;
                    $isFirst = true;
        
                    for($i=0; $i<count($this->original); $i++) {
                        if($isFirst) {
                            $biggestNo = $this->original[$i]->$key;
                            $isFirst = false;
                        }
                        if ($this->original[$i]->$key > $biggestNo) {
                            $biggestNo = $this->original[$i]->$key;
                        }
                    }
        
                    return $biggestNo;
                } else {
                    return new ApplicationException("Key {$key} does not exists in set","Lynx/System/Exception/SetException.php");
                }
            } else {
                
                if ($this->arrayType == 'associative') {

                    $biggestNo = 0;
                    $isFirst = true;

                    foreach($this->original as $key => $value) {
                        if($isFirst) {
                            $biggestNo = $value;
                            $isFirst = false;
                        }
                        if ($value > $biggestNo) {
                            $biggestNo = $value;
                        }
                    }
        
                    return $biggestNo;

                } else if($this->arrayType === 'index') {
                    $biggestNo = 0;
                    $isFirst = true;
        
                    for($i=0; $i<count($this->original); $i++) {
                        if($isFirst) {
                            $biggestNo = $this->original[$i];
                            $isFirst = false;
                        }
                        if ($this->original[$i] > $biggestNo) {
                            $biggestNo = $this->original[$i];
                        }
                    }
        
                    return $biggestNo;
                } else {
                    return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
                }

            }

            if ($this->arrayType == 'associative') {

            } else if($this->arrayType === 'index') {

            } else {
                return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
            }
        } else {
            return new ApplicationException("Set does not contain an array.","Lynx/System/Exception/SetException.php");
        }
    }

    public function min()
    {
        return min($this->original);
    }

    public function max()
    {
        return max($this->original);
    }

    public function sum()
    {
        return array_sum($this->original);
    }

    public function avg()
    {
        return array_sum($this->original)/count($this->original);
    }

    public function median()
    {
        $count = count($this->original);
        $middleval = floor(($count-1)/2);
        if($count % 2) {
            $median = $this->original[$middleval];
        } else {
            $low = $this->original[$middleval];
            $high = $this->original[$middleval+1];
            $median = (($low+$high)/2);
        }
        return $median;
    }
   
    public function mode()
    {
        $v = array_count_values($this->original);
        arsort($v);
        foreach($v as $k => $v) {
            $modes[] = $k;
        }
        return $modes[0];
    }

    public function range()
    {
        return max($this->original) - min($this->original);
    }

    public function variance()
    {
        $mean = $this->avg();
        $sum = 0;
        foreach($this->original as $value) {
            $sum += pow($value - $mean, 2);
        }
        return $sum / count($this->original);
    }

    public function stdDev()
    {
        return sqrt($this->variance());
    }

    public function sort($order = 'asc')
    {
        if ($order === 'asc') {
            sort($this->original);
        } else if ($order === 'desc') {
            rsort($this->original);
        } else {
            return new ApplicationException("Invalid order type. Order type must be asc or desc.","Lynx/System/Exception/SetException.php");
        }
        return $this;
    }

    public function shuffle()
    {
        shuffle($this->original);
        return $this;
    }

    public function reverse()
    {
        $this->original = array_reverse($this->original);
        return $this;
    }

    public function unique()
    {
        $this->original = array_unique($this->original);
        return $this;
    }

    public function keys()
    {
        return array_keys($this->original);
    }

    public function values()
    {
        return array_values($this->original);
    }

    public function remove($key)
    {
        if (array_key_exists($key, $this->original)) {
            unset($this->original[$key]);
            return $this;
        } else {
            return new ApplicationException("Key {$key} does not exists in set","Lynx/System/Exception/SetException.php");
        }
    }

    public function count()
    {
        return count($this->original);
    }

    public function get()
    {
        return $this->original;
    }

    public function set($data)
    {
        $this->original = $data;
        return $this;
    }

    public function getSetType()
    {
        return $this->setType;
    }

    public function getArrayType()
    {
        return $this->arrayType;
    }

    public function getOriginal()
    {
        return $this->original;
    }

    public function setOriginal($original)
    {
        $this->original = $original;
        return $this;
    }

    public function chunk($count = 2000)
    {
        return array_chunk($this->original,$count);
    }    

    public function chunkBy($key,$count = 2000)
    {
        $chunks = array();
        $chunk = array();
        $i = 0;
        foreach($this->original as $item) {
            if ($i == $count) {
                $chunks[] = $chunk;
                $chunk = array();
                $i = 0;
            }
            $chunk[] = $item;
            $i++;
        }
        $chunks[] = $chunk;
        return $chunks;
    }

    public function chunkByValue($value,$count = 2000)
    {
        $chunks = array();
        $chunk = array();
        $i = 0;
        foreach($this->original as $item) {
            if ($i == $count) {
                $chunks[] = $chunk;
                $chunk = array();
                $i = 0;
            }
            $chunk[] = $item;
            $i++;
        }
        $chunks[] = $chunk;
        return $chunks;
    }

    public function in($value)
    {
        if (in_array($value,$this->original)) {
            return true;
        } else {
            return false;
        }
    }

    public function inKey($key)
    {
        if (array_key_exists($key,$this->original)) {
            return true;
        } else {
            return false;
        }
    }

    public function whereIs($key,$value)
    {
        $results = array();
        if (!is_array($this->original[$key])) {return new ApplicationException("Key does not contain an array.","Lynx/System/Exception/SetException.php");}
        foreach($this->original[$key] as $item) {
            if ($item == $value) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereIn($key,$values)
    {
        $results = array();
        foreach($this->original as $item) {
            if (in_array($item[$key],$values)) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereNotIn($key,$values)
    {
        $results = array();
        foreach($this->original as $item) {
            if (!in_array($item[$key],$values)) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereBetween($key,$min,$max)
    {
        $results = array();
        foreach($this->original as $item) {
            if ($item[$key] >= $min && $item[$key] <= $max) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereNotBetween($key,$min,$max)
    {
        $results = array();
        foreach($this->original as $item) {
            if ($item[$key] < $min || $item[$key] > $max) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereNull($key)
    {
        $results = array();
        foreach($this->original as $item) {
            if ($item[$key] === null) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereNotNull($key)
    {
        $results = array();
        foreach($this->original as $item) {
            if ($item[$key] !== null) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereEmpty($key)
    {
        $results = array();
        foreach($this->original as $item) {
            if (empty($item[$key])) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function whereNotEmpty($key)
    {
        $results = array();
        foreach($this->original as $item) {
            if (!empty($item[$key])) {
                $results[] = $item;
            }
        }
        return $results;
    }

    public function setEloquent($model, $executionTime)
    {
        $this->eloquent = $model;
        $this->executionTime = $executionTime;
        return $this;
    }


}