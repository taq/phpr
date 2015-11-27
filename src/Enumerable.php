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
     * @return mixed array
     */
    public function sort()
    {
        $ar = array_merge(array(), $this->_array);
        sort($ar);
        return $ar;
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
        return array_filter($this->_array, $func);
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
        return array_map($func, $this->_array);
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
        return sizeof($this->_array) == sizeof($rst);
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
        return sizeof($this->select($func)) > 0;
    }
}

