<?php
/**
 * Min and max code sample
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

$col = new PHPR\Collection([1, 2, 3, 4, 5]);
echo "sum is ".$col->inject(function($memo, $value) { return $memo + $value; })."\n";
echo "sum is ".$col->inject(function($memo, $value) { return $memo + $value; }, 10)."\n";
?>
