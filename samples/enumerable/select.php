<?php
/**
 * Select code sample
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
$rst = $col->select(function($e) {
    return strlen($e) > 3;
});
var_dump($rst->values());

$filtered = array_filter($col->values(), function($e) {
    return strlen($e) > 3;
});
var_dump($filtered);
?>
