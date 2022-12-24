<?php

namespace Lynx\System\Set;

use Lynx\System\Exception\ApplicationException;

class Set {
    
    //   all array functions with static metohds

    public static function all($array)
    {
        return $array;
    }

    public static function push($array, $value)
    {
        $array[] = $value;
        return $array;
    }

    public static function pop($array, $value)
    {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function contains($array, $value)
    {
        return in_array($value, $array);
    }

    public static function first($array)
    {
        return $array[0];
    }

    public static function last($array)
    {
        return end($array);
    }

    public static function count($array)
    {
        return count($array);
    }

    public static function sum($array)
    {
        return array_sum($array);
    }

    public static function avg($array)
    {
        return array_sum($array) / count($array);
    }

    public static function min($array)
    {
        return min($array);
    }

    public static function max($array)
    {
        return max($array);
    }

    public static function sort($array)
    {
        sort($array);
        return $array;
    }

    public static function reverse($array)
    {
        return array_reverse($array);
    }

    public static function shuffle($array)
    {
        shuffle($array);
        return $array;
    }

    public static function unique($array)
    {
        return array_unique($array);
    }

    public static function keys($array)
    {
        return array_keys($array);
    }

    public static function values($array)
    {
        return array_values($array);
    }

    public static function merge($array1, $array2)
    {
        return array_merge($array1, $array2);
    }

    public static function intersect($array1, $array2)
    {
        return array_intersect($array1, $array2);
    }

    public static function diff($array1, $array2)
    {
        return array_diff($array1, $array2);
    }

    public static function slice($array, $offset, $length = null)
    {
        return array_slice($array, $offset, $length);
    }

    public static function chunk($array, $size)
    {
        return array_chunk($array, $size);
    }

    public static function pad($array, $size, $value)
    {
        return array_pad($array, $size, $value);
    }

    public static function flip($array)
    {
        return array_flip($array);
    }

    public static function search($array, $value)
    {
        return array_search($value, $array);
    }

    public static function filter($array, $callback)
    {
        return array_filter($array, $callback);
    }

    public static function map($array, $callback)
    {
        return array_map($callback, $array);
    }

    public static function reduce($array, $callback, $initial = null)
    {
        return array_reduce($array, $callback, $initial);
    }

    public static function column($array, $column)
    {
        return array_column($array, $column);
    }

    public static function pluck($array, $column)
    {
        return array_column($array, $column);
    }

    public static function groupBy($array, $column)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[$value[$column]][] = $value;
        }
        return $result;
    }

    public static function flatten($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flatten($value));
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }

    public static function flattenKeys($array, $prefix = '')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flattenKeys($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }

    public static function flattenValues($array, $prefix = '')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flattenValues($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $value] = $key;
            }
        }
        return $result;
    }

    public static function flattenKeysValues($array, $prefix = '')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flattenKeysValues($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $key] = $prefix . $value;
            }
        }
        return $result;
    }

    public static function flattenValuesKeys($array, $prefix = '')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flattenValuesKeys($value, $prefix . $key . '.'));
            } else {
                $result[$prefix . $value] = $prefix . $key;
            }
        }
        return $result;
    }

    public static function chunkBy($array, $size)
    {
        $result = [];
        $chunk = [];
        foreach ($array as $key => $value) {
            $chunk[] = $value;
            if (count($chunk) == $size) {
                $result[] = $chunk;
                $chunk = [];
            }
        }
        if (count($chunk) > 0) {
            $result[] = $chunk;
        }
        return $result;
    }

    public static function collapse($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $value);
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }   

    public static function combine($array1, $array2)
    {
        return array_combine($array1, $array2);
    }

    public static function crossJoin($array1, $array2)
    {
        $result = [];
        foreach ($array1 as $key1 => $value1) {
            foreach ($array2 as $key2 => $value2) {
                $result[] = [$value1, $value2];
            }
        }
        return $result;
    }

    public static function crossJoinMultiple($arrays)
    {
        $result = [[]];
        foreach ($arrays as $key => $array) {
            $result = self::crossJoin($result, $array);
        }
        return $result;
    }

    public static function crossJoinMultipleWithKeys($arrays)
    {
        $result = [[]];
        foreach ($arrays as $key => $array) {
            $result = self::crossJoin($result, self::keys($array));
        }
        return $result;
    }

    public static function duplicates($array)
    {
        $result = [];
        $values = [];
        foreach ($array as $key => $value) {
            if (in_array($value, $values)) {
                $result[] = $value;
            } else {
                $values[] = $value;
            }
        }
        return $result;
    }

    public static function duplicatesWithKeys($array)
    {
        $result = [];
        $values = [];
        foreach ($array as $key => $value) {
            if (in_array($value, $values)) {
                $result[$key] = $value;
            } else {
                $values[] = $value;
            }
        }
        return $result;
    }

    public static function except($array, $keys)
    {
        return array_diff_key($array, array_flip($keys));
    }

    public static function exceptByValue($array, $values)
    {
        return array_diff($array, $values);
    }
    
    public static function mapKeys($array, $callback)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[$callback($value, $key)] = $value;
        }
        return $result;
    }

    public static function mapValues($array, $callback)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[$key] = $callback($value, $key);
        }
        return $result;
    }

    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip($keys));
    }

    public static function onlyByValue($array, $values)
    {
        return array_intersect($array, $values);
    }

    public static function partition($array, $callback)
    {
        $result = [[], []];
        foreach ($array as $key => $value) {
            $result[$callback($value, $key) ? 0 : 1][] = $value;
        }
        return $result;
    }

    public static function prepend($array, $value, $key = null)
    {
        if ($key) {
            $array = [$key => $value] + $array;
        } else {
            array_unshift($array, $value);
        }
        return $array;
    }

    public static function split($array, $size)
    {
        $result = [];
        $chunk = [];
        foreach ($array as $key => $value) {
            $chunk[] = $value;
            if (count($chunk) == $size) {
                $result[] = $chunk;
                $chunk = [];
            }
        }
        if (count($chunk) > 0) {
            $result[] = $chunk;
        }
        return $result;
    }

    public static function random($array, $number = 1)
    {
        $keys = array_rand($array, $number);
        if ($number == 1) {
            return $array[$keys];
        } else {
            $result = [];
            foreach ($keys as $key) {
                $result[] = $array[$key];
            }
            return $result;
        }
    }

    public static function add($array, $value, $position)
    {
        $result = [];
        $i = 0;
        foreach ($array as $key => $val) {
            if ($i == $position) {
                $result[] = $value;
            }
            $result[] = $val;
            $i++;
        }
        return $result;
    }

    public static function remove($array, $position)
    {
        $result = [];
        $i = 0;
        foreach ($array as $key => $val) {
            if ($i != $position) {
                $result[] = $val;
            }
            $i++;
        }
        return $result;
    }
    
}