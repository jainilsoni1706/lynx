<?php

namespace Lynx\System\Set;

use Lynx\System\Exception\ApplicationException;

class Set {
    
    public static $collection;
    
    public static function collect($array)
    {
        self::$collection = $array;
        return new static($array);
    }

    public function __construct($array)
    {
        self::$collection = $array;
        $this->items = $array;
    }
    
    public function toJson()
    {
        return json_encode($this->items);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function pluck($key)
    {
        if (array_key_exists($key, $this->items[0])) {
            $result = [];
            foreach ($this->items as $item) {
                $result[] = $item->$key;
            }
            return $result;

        } else {
            return new ApplicationException("Key {$key} does not exist in " . get_class($this));
        }
    }

    public function all()
    {
        return $this->items;
    }

    public function average($key) 
    {
        if (array_key_exists($key, $this->items[0])) {

            return round($this->max($key) / 2);

        } else {
            return new ApplicationException("Key {$key} does not exist in " . get_class($this));
        }
    }

    public function max($key) 
    {
        if (array_key_exists($key, $this->items[0])) {

            $biggestNo = 0;
            $isFirst = true;

            for($i=0; $i<count($this->items); $i++) {
                if($isFirst) {
                    $biggestNo = $this->items[$i]->$key;
                    $isFirst = false;
                }
                if ($this->items[$i]->$key > $biggestNo) {
                    $biggestNo = $this->items[$i]->$key;
                }
            }

            return $biggestNo;

        } else {
            return new ApplicationException("Key {$key} does not exist in " . get_class($this));
        }
    }

    public function min($key)
    {
        if (array_key_exists($key, $this->items[0])) {

            $smallestNo = 0;
            $isFirst = true;

            for($i=0; $i<count($this->items); $i++) {
                if($isFirst) {
                    $smallestNo = $this->items[$i]->$key;
                    $isFirst = false;
                }
                if ($this->items[$i]->$key < $smallestNo) {
                    $smallestNo = $this->items[$i]->$key;
                }
            }

            return $smallestNo;

        } else {
            return new ApplicationException("Key {$key} does not exist in " . get_class($this));
        }
    }

    public function chunk($number = 2000) : array
    {
        $outerWrapper = [];
        $innerWrapper = array();
        $count = 1;

        foreach (self::$collection as $item) {

            $innerWrapper[] = $item;

            if ($count == $number) {
                $outerWrapper[] = $innerWrapper;
                $number = $number + $number;
                $innerWrapper = array();
            }

            $count++;
        }

        return $outerWrapper;
    }

    public function hasArrayInside() : int
    {
        $hasArray = 0;
        foreach (self::$collection as $item) {
            if (is_array($item)) {
                $hasArray = 1;
            }
        }

        return $hasArray;
    }

    public function hasObjectInside() : int
    {
        $hasObject = 0;
        foreach (self::$collection as $item) {
            if (is_object($item)) {
                $hasObject = 1;
            }
        }

        return $hasObject;
    }
    

    public function arrayHasLevel($levelCount = 0) : int 
    {
        $levelCount = $levelCount;

        if (count(self::$collection) >= $levelCount) {
            if (self::$collection[$levelCount] == null) {
                return $levelCount;
            } else {
                return self::arrayHasLevel($levelCount + 1);
            }
        }

        return $levelCount;
    }

    public function first()
    {
        return self::$collection[0];
    }

}