<?php
/**
 * Each code sample
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

// no associative
$col->each(function($e) {
    echo "$e\n";
});

// associative
$col->each(function($key, $val) {
    echo "$key = $val\n";
});
