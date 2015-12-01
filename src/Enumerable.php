<?php
/**
 * Enumerable trait
 *
 * PHP version 5.5
 *
 * @category Traits
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/phpr
 */
namespace PHPR;

trait Enumerable
{
    /**
     * Iterator
     *
     * @param mixed $func function to call
     *
     * @return null
     */
    public function each($func)
    {
        $args = (new \ReflectionFunction($func))->getNumberOfParameters();
        foreach ($this->_array as $key => $value) {
            $args === 1 ? $func($value) : $func($key, $value);
        }
    }

    /**
     * Check if the value is inside the collection
     *
     * @param mixed $val value
     *
     * @return true or false
     */
    public function includes($val)
    {
        return in_array($val, $this->_array);
    }

    /**
     * Sort the values, returning a new array
     *
     * @return mixed Collection
     */
    public function sort()
    {
        $ar = array_merge(array(), $this->_array);
        sort($ar);
        return new Collection($ar);
    }

    /**
     * Minimum collection value
     *
     * @return mixed mininum
     */
    public function min()
    {
        return min($this->_array);
    }

    /**
     * Maximum collection value
     *
     * @return mixed maximum
     */
    public function max()
    {
        return max($this->_array);
    }

    /**
     * Select only the elements that satisfy the function condition
     *
     * @param mixed $func function where when returned true, element is selected
     *
     * @return mixed array
     */
    public function select($func)
    {
        $rst = array_filter($this->_array, $func);
        if (!$this->_isAssoc()) {
            $rst = array_values($rst);
        }
        return new Collection($rst);
    }

    /**
     * Reject only the elements that satisfy the function condition
     *
     * @param mixed $func function where when returned true, element is rejected
     *
     * @return mixed array
     */
    public function reject($func)
    {
        $selected = $this->select($func);
        $diff     = array_diff($this->values(), $selected->values());
        if (!$this->_isAssoc()) {
            $diff = array_values($diff);
        }
        return new Collection($diff);
    }

    /**
     * Change all the collection values
     *
     * @param mixed $func function to change elements
     *
     * @return mixed array
     */
    public function map($func)
    {
        return new Collection(array_map($func, $this->_array));
    }

    /**
     * Test if all elements satisfy a condition
     *
     * @param mixed $func function to check elements
     *
     * @return boolean
     */
    public function all($func)
    {
        $rst = $this->select($func);
        return sizeof($this->_array) == sizeof($rst->values());
    }

    /**
     * Test if any elements satisfy a condition
     *
     * @param mixed $func function to check elements
     *
     * @return boolean
     */
    public function any($func)
    {
        return sizeof($this->select($func)->values()) > 0;
    }

    /**
     * Make a partition on the collection, returning two collections
     *
     * @param mixed $func function to partition elements
     *
     * @return mixed collections
     */
    public function partition($func)
    {
        $args = (new \ReflectionFunction($func))->getNumberOfParameters();
        $asso = $this->_isAssoc();
        $pos  = [];
        $neg  = [];

        foreach ($this->_array as $key => $value) {
            $rst = $args === 1 ? $func($value) : $func($key, $value);

            if ($asso) {
                $rst ? $pos[$key] = $value : $neg[$key] = $value;
            } else {
                $rst ? $pos[] = $value : $neg[] = $value;
            }
        }
        return [new Collection($pos), new Collection($neg)];
    }

    /**
     * Check if the internal array is associative
     *
     * @return boolean
     */
    private function _isAssoc()
    {
        return array_keys($this->_array) !== range(0, count($this->_array) - 1);
    }

    /**
     * Reduce collection
     *
     * @param mixed $func function to partition elements
     * @param mixed $ini  initial value
     *
     * @return mixed value
     */
    public function inject($func, $ini = null)
    {
        return array_reduce($this->_array, $func, $ini);
    }

    /**
     * Find the first found element value
     *
     * @param mixed $func function to find elements
     *
     * @return mixed value
     */
    public function find($func)
    {
        $args = (new \ReflectionFunction($func))->getNumberOfParameters();
        foreach ($this->_array as $key => $value) {
            $rst = $args === 1 ? $func($value) : $func($key, $value);
            if ($rst) {
                return $value;
            }
        }
        return null;
    }

    /**
     * Group by 
     *
     * @param mixed $func function to group
     *
     * @return mixed value
     */
    public function groupBy($func)
    {
        $rtn  = [];
        $args = (new \ReflectionFunction($func))->getNumberOfParameters();
        foreach ($this->_array as $key => $value) {
            $rst = $args === 1 ? $func($value) : $func($key, $value);
            if (!isset($rtn[$rst])) {
                $rtn[$rst] = [];
            }
            array_push($rtn[$rst], $value);
        }
        return new Collection($rtn);
    }
}

