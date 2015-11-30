<?php
/**
 * Partition code sample
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

$col  = new PHPR\Collection([1, 2, 3, 4, 5]);
$cols = $col->partition(function($e) {
    return $e % 2 == 0;
});

echo "even numbers:\n";
var_dump($cols[0]->values());

echo "odd numbers:\n";
var_dump($cols[1]->values());
?>

