<?php
/**
 * Enumerable class tests
 *
 * PHP version 5.5
 *
 * @category Tests
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/torm
 */
require_once "../vendor/autoload.php";

/**
 * Cache test main class 
 *
 * PHP version 5.5
 *
 * @category Tests
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/torm
 */
class EnumerableTest extends PHPUnit_Framework_TestCase
{
    private static $_col = null;

    /**
     * Run before initialization
     *
     * @return null
     */
    public static function setUpBeforeClass()
    {
        self::$_col = new PHPR\Collection([0 => "zero", 1 => "one", 2 => "two"]);
    }

    /**
     * Test the each method
     *
     * @return null
     */
    public function testEach()
    {
        $str = "";
        self::$_col->each(function($e) use (&$str) {
            $str .= $e;
        });
        $this->assertEquals("zeroonetwo", $str);
    }

    /**
     * Test the each method, with key
     *
     * @return null
     */
    public function testEachWithKey()
    {
        $str = "";
        self::$_col->each(function($key, $val) use (&$str) {
            $str .= "$key$val";
        });
        $this->assertEquals("0zero1one2two", $str);
    }

    /**
     * Test if an element is inside the collection
     *
     * @return null
     */
    public function testInclude()
    {
        $this->assertTrue(self::$_col->includes("one"));
        $this->assertFalse(self::$_col->includes("three"));
    }

    /**
     * Test the collection sorting
     *
     * @return null
     */
    public function testSort()
    {
        $sorted = self::$_col->sort();
        $this->assertEquals("one",  $sorted[0]);
        $this->assertEquals("two",  $sorted[1]);
        $this->assertEquals("zero", $sorted[2]);
    }

    /**
     * Test minimum value
     *
     * @return null
     */
    public function testMin()
    {
        $this->assertEquals("one", self::$_col->min());
    }

    /**
     * Test maximum value
     *
     * @return null
     */
    public function testMax()
    {
        $this->assertEquals("zero", self::$_col->max());
    }

    /**
     * Test selected elements
     *
     * @return null
     */
    public function testSelect()
    {
        $selected = self::$_col->select(function($e) {
            return strlen($e) > 3;
        });
        $this->assertEquals(1, sizeof($selected));
        $this->assertEquals("zero", $selected[0]);
    }

    /**
     * Test changing elements
     *
     * @return null
     */
    public function testMap()
    {
        $changed = self::$_col->map(function($e) {
            return strrev($e);
        });
        $this->assertEquals(3, sizeof($changed));
        $this->assertEquals("orez", $changed[0]);
        $this->assertEquals("eno",  $changed[1]);
        $this->assertEquals("owt",  $changed[2]);
    }

    /**
     * Test if all elements satisfy a condition
     *
     * @return null
     */
    public function testAll()
    {
        $this->assertTrue(self::$_col->all(function($e)  { return strlen($e) > 2; }));
        $this->assertFalse(self::$_col->all(function($e) { return strlen($e) > 3; }));
    }

    /**
     * Test if any elements satisfy a condition
     *
     * @return null
     */
    public function testAny()
    {
        $this->assertTrue(self::$_col->any(function($e)  { return strlen($e) > 3; }));
        $this->assertFalse(self::$_col->any(function($e) { return strlen($e) > 4; }));
    }
}
