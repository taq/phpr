<?php
/**
 * String class
 *
 * Replacement for the standard String class
 *
 * PHP version 5.5
 *
 * @category Strings
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/phpr
 */
namespace PHPR;

/**
 * String class 
 *
 * PHP version 5.5
 *
 * @category Strings
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/phpr
 */
class String
{
    private $_value = null;

    /**
     * Constructor
     *
     * @param mixed $value internal string
     */
    public function __construct($value)
    {
        $this->_value = $value;
    }

    /**
     * Convert to regular string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_value;
    }

    /**
     * Check if is a ASCII string
     *
     * @return boolean ASCII or not
     */
    public function asciiOnly()
    {
        return mb_check_encoding($this->_value, "ASCII");
    }

    /**
     * Return an array with the string bytes
     *
     * @return mixed array
     */
    public function bytes()
    {
        return str_split($this->_value);
    }

    /**
     * Return the String bytes size
     *
     * @return integer size
     */
    public function byteSize()
    {
        return mb_strlen($this->_value);
    }

    /**
     * Capitalize string
     *
     * @return capitalized string
     */
    public function capitalize()
    {
        return new String(ucfirst(strtolower($this->_value)));
    }

    /**
     * Convert to char array
     *
     * @return mixed char array
     */
    public function chars()
    {
        return preg_split('/(.{0})/us', $this->_value, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    }

    /**
     * Delete an inner string on a new object copy
     *
     * @param string $what to delete
     *
     * @return mixed string
     */
    public function delete($what)
    {
        return new String(str_replace($what, "", $this->_value));
    }

    /**
     * Convert to downcase on a new object copy
     *
     * @return mixed string
     */
    public function downcase()
    {
        return new String(strtolower($this->_value));
    }

    /**
     * Convert to upcase on a new object copy
     *
     * @return mixed string
     */
    public function upcase()
    {
        return new String(strtoupper($this->_value));
    }

    /**
     * Run a function on each byte
     *
     * @param mixed $func function to run
     *
     * @return null
     */
    public function eachByte($func)
    {
        foreach ($this->bytes() as $byte) {
            $func($byte);
        }
    }

    /**
     * Run a function on each char
     *
     * @param mixed $func function to run
     *
     * @return null
     */
    public function eachChar($func)
    {
        foreach ($this->chars() as $byte) {
            $func($byte);
        }
    }

    /**
     * Run a function on each line
     *
     * @param mixed  $func      function to run
     * @param string $delimiter to split lines
     *
     * @return null
     */
    public function eachLine($func, $delimiter = "\n")
    {
        foreach (preg_split("/$delimiter/", $this->_value) as $line) {
            $func($line);
        }
    }

    /**
     * Check is is an empty string
     *
     * @return boolean empty or not
     */
    public function isEmpty()
    {
        return sizeof($this->chars()) < 1;
    }

    /**
     * Substitute the first ocurrence of pattern on a new object
     *
     * @param string $pattern     to search
     * @param string $replacement to use
     *
     * @return mixed new object
     */
    public function sub($pattern, $replacement)
    {
        return new String(preg_replace($pattern, $replacement, $this->_value, 1));
    }

    /**
     * Substitute all ocurrences of pattern on a new object
     *
     * @param string $pattern     to search
     * @param string $replacement to use
     *
     * @return mixed new object
     */
    public function gsub($pattern, $replacement)
    {
        return new String(preg_replace($pattern, $replacement, $this->_value));
    }
}
?>
