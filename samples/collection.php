<?php
/**
 * Collection code sample
 *
 * PHP version 5.5
 *
 * @category Samples
 * @package  PHPR
 * @author   Eustáquio Rangel <taq@bluefish.com.br>
 * @license  http://www.gnu.org/copyleft/gpl.html GPL
 * @link     http://github.com/taq/torm
 */
require_once "../vendor/autoload.php";

$col = new PHPR\Collection(["one", "two", "three"]);
echo $col[0]."\n";
echo $col[1]."\n";
echo $col[2]."\n";
?>
