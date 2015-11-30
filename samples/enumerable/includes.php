<?php
/**
 * Includes code sample
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
echo "one is ".($col->includes("one") ? "" : "NOT")."present in collection\n";
echo "four is ".($col->includes("four") ? "" : "NOT ")."present in collection\n";
?>
