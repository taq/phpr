<?php
/**
 * Array access interface trait
 *
 * Implements methods of: 
 * http://php.net/manual/en/class.arrayaccess.php
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

trait ArrayAccessInterface
{
    /**
     * Assign a value to the specified offset
     *
     * @param mixed $offset the offset to assign the value to 
     * @param mixed $value  the value to set
     *
     * @return null
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_array[] = $value;
        } else {
            $this->_array[$offset] = $value;
        }
    }

    /**
     * Whether an offset exists
     *
     * @param mixed $offset An offset to check for
     *
     * @return Returns TRUE on success or FALSE on failure
     */
    public function offsetExists($offset)
    {
        return isset($this->_array[$offset]);
    }

    /**
     * Unset an offset
     *
     * @param mixed $offset The offset to unset
     *
     * @return null
     */
    public function offsetUnset($offset)
    {
        unset($this->_array[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset the offset to retrieve
     *
     * @return can return all value types
     */
    public function offsetGet($offset)
    {
        return isset($this->_array[$offset]) ? $this->_array[$offset] : null;
    }
}
?>
