<?php
/**
 * All code sample
 *
 * PHP version 5.5
 *
 * @category Samples
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/torm
 */
require_once "../../vendor/autoload.php";

$col = new PHPR\Collection(["one", "two", "three"]);
echo "all elements are larger than 2 chars? ".($col->all(function($e) { return strlen($e) > 2; }) ? "YES" : "NO")."\n";
echo "all elements are larger than 3 chars? ".($col->all(function($e) { return strlen($e) > 3; }) ? "YES" : "NO")."\n";
?>

