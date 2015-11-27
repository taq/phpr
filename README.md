# PHPR

## What is - motivation

Trying to extend some PHP objects to be used on a more functional way.
Once one PHP developer said that nowadays IDE's can help us to avoid
remembering the lack of standardization some PHP methods has. As I don't
use an IDE, as lots of developers out there, I don't agree with that and
I'm kind of tired to try to remember if on `array_filter` or `array_map`
the array goes first and the function goes last or what order they are.

So, I think it's easier to use on a function and Ruby style way, where
we can call the methods on the **object** and it returns what we need.

One notable exception to try to make things easier is that PHP have some 
reserved and constant words we cannot reuse even inside a namespace, like `Array`.
So I needed to call the `Array` class `Collection`, otherwise it will be
impossible to implement. All the classes have the original object 
accessible with the `value` method.

Other thing is that some methods just returns a value or null, true or false.
No more guesses and wonderings of what happened if it returns 0 or false.

## Samples

```
$t = new PHPR\Collection([0 => "zero", 1 => "one", 2 => "two"]);

// outputs:
// zero
// one
// two
$t->each(function($e) {
   echo "$e\n";
});

// outputs:
// 0 - zero
// 1 - one
// 2 - two
$t->each(function($key, $val) {
   echo "$key - $val\n";
});

$t->includes("one");    // true
$t->includes("three");  // false

// outputs:
// array(3) {
//   [0] =>
//   string(3) "one"
//   [1] =>
//   string(3) "two"
//   [2] =>
//   string(4) "zero"
// }
$sorted = $t->sort();
var_dump($sorted);

$t->min(); // "one"
$t->max(); // "zero"

// outputs:
// array(1) {
//   [0] =>
//   string(4) "zero"
// }
$selected = $t->select(function($e) {
   return strlen($e) > 3;
});
var_dump($selected);

// outputs:
// array(3) {
//   [0] =>
//   string(4) "orez"
//   [1] =>
//   string(3) "eno"
//   [2] =>
//   string(3) "owt"
// }
$changed = $t->map(function($e) {
   return strrev($e);
});
var_dump($changed);

$t->all(function($e) { return strlen($e) > 2; })); // true
$t->all(function($e) { return strlen($e) > 3; })); // false

$t->any(function($e) { return strlen($e) > 3; })); // true
$t->any(function($e) { return strlen($e) > 4; })); // false
```
