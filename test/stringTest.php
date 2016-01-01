<?php
/**
 * String class tests
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
 * String test main class 
 *
 * PHP version 5.5
 *
 * @category Tests
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/torm
 */
class StringTest extends PHPUnit_Framework_TestCase
{
    private static $_str = null;

    /**
     * Run before initialization
     *
     * @return null
     */
    public static function setUpBeforeClass()
    {
        self::$_str = new PHPR\String("test");
    }

    /**
     * Test the ASCII only method
     *
     * @return null
     */
    public function testASCII()
    {
        $this->assertTrue(self::$_str->asciiOnly());
        $str = new PHPR\String("eustáquio");
        $this->assertFalse($str->asciiOnly());
    }

    /**
     * Test the bytes method
     *
     * @return null
     */
    public function testBytes()
    {
        $rst = self::$_str->bytes();
        $this->assertEquals(4, sizeof($rst));
        $this->assertEquals("t", $rst[0]);
        $this->assertEquals("e", $rst[1]);
        $this->assertEquals("s", $rst[2]);
        $this->assertEquals("t", $rst[3]);

        $str = new PHPR\String("G\xc3\xb6del");
        $rst = $str->bytes();
        $this->assertEquals(6, sizeof($rst));
    }

    /**
     * Test the byte size
     *
     * @return null
     */
    public function testByteSize()
    {
        $str = new PHPR\String("G\xc3\xb6del");
        $this->assertEquals(5, $str->byteSize());
        $str = new PHPR\String("eustáquio");
        $this->assertEquals(9, $str->byteSize());
        $this->assertEquals(4, self::$_str->byteSize());
    }

    /**
     * Test the capitalize method
     *
     * @return null
     */
    public function testCapitalize()
    {
        $this->assertEquals("Test", self::$_str->capitalize());
        $this->assertEquals("This is a test", (new PHPR\String("THIS IS A TEST"))->capitalize());
        $this->assertEquals("This is a test", (new PHPR\String("this is a TEST"))->capitalize());
    }

    /**
     * Test the chars method
     *
     * @return null
     */
    public function testChars()
    {
        $rst = self::$_str->chars();
        $this->assertEquals(4, sizeof($rst));
        $this->assertEquals("t", $rst[0]);
        $this->assertEquals("e", $rst[1]);
        $this->assertEquals("s", $rst[2]);
        $this->assertEquals("t", $rst[3]);

        $str = new PHPR\String("G\xc3\xb6del");
        $rst = $str->chars();
        $this->assertEquals(5, sizeof($rst));
        $this->assertEquals("G", $rst[0]);
        $this->assertEquals("ö", $rst[1]);
        $this->assertEquals("d", $rst[2]);
        $this->assertEquals("e", $rst[3]);
        $this->assertEquals("l", $rst[4]);

        $str = new PHPR\String("pé");
        $rst = $str->chars();
        $this->assertEquals(2, sizeof($rst));
        $this->assertEquals("p", $rst[0]);
        $this->assertEquals("é", $rst[1]);
    }

    /**
     * Test the delete method
     *
     * @return null
     */
    public function testDelete()
    {
        $this->assertEquals("es",   self::$_str->delete("t"));
        $this->assertEquals("tet",  self::$_str->delete("s"));
        $this->assertEquals("st",   self::$_str->delete("te"));
        $this->assertEquals("test", self::$_str->delete("bla"));
    }

    /**
     * Test the downcase method
     *
     * @return null
     */
    public function testDowncase()
    {
        $this->assertEquals("test", (new PHPR\String("TeSt"))->downcase());
    }

    /**
     * Test the upcase method
     *
     * @return null
     */
    public function testUpcase()
    {
        $this->assertEquals("TEST", (new PHPR\String("TeSt"))->upcase());
    }

    /**
     * Test the each byte method
     *
     * @return null
     */
    public function testEachByte()
    {
        $str = new PHPR\String("G\xc3\xb6del");
        $rst = [];
        $str->eachByte(function($byte) use (&$rst) {
            array_push($rst, $byte);
        });
        $this->assertEquals($str, join($rst));
    }

    /**
     * Test the each char method
     *
     * @return null
     */
    public function testEachChar()
    {
        $str = new PHPR\String("G\xc3\xb6del");
        $rst = [];
        $str->eachChar(function($byte) use (&$rst) {
            array_push($rst, $byte);
        });
        $this->assertEquals($str, join($rst));
        $this->assertEquals("ö", $rst[1]);
    }

    /**
     * Test the each line method
     *
     * @return null
     */
    public function testEachLine()
    {
        $str = new PHPR\String("hello\nworld");
        $rst = [];
        $str->eachLine(function($line) use (&$rst) {
            array_push($rst, $line);
        });
        $this->assertEquals(2, sizeof($rst));
        $this->assertEquals("hello", $rst[0]);
        $this->assertEquals("world", $rst[1]);
    }

    /**
     * Test the each line method, with a different delimiter
     *
     * @return null
     */
    public function testEachLineWithDelimiter()
    {
        $str = new PHPR\String("hello\tworld");
        $rst = [];
        $str->eachLine(function($line) use (&$rst) {
            array_push($rst, $line);
        }, "\t");
        $this->assertEquals(2, sizeof($rst));
        $this->assertEquals("hello", $rst[0]);
        $this->assertEquals("world", $rst[1]);
    }

    /**
     * Test the isEmpty method
     *
     * @return null
     */
    public function testIsEmpty()
    {
        $this->assertTrue((new PHPR\String(""))->isEmpty());
        $this->assertFalse(self::$_str->isEmpty());
    }

    /**
     * Test the sub method
     *
     * @return null
     */
    public function testSub()
    {
        $this->assertEquals("nest", self::$_str->sub("/t/", "n"));
        $this->assertEquals("one * two 2", (new PHPR\String("one 1 two 2"))->sub("/[0-9]/", "*"));
    }

    /**
     * Test the gsub method
     *
     * @return null
     */
    public function testGsub()
    {
        $this->assertEquals("nesn", self::$_str->gsub("/t/", "n"));
        $this->assertEquals("one * two *", (new PHPR\String("one 1 two 2"))->gsub("/[0-9]/", "*"));
    }
}
?>
