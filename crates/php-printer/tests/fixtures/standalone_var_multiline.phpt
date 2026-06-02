===source===
<?php
/**
 * @var Foo $x
 */
foreach ($items as $x) {
    $x->process();
}
===print===
<?php
/**
* @var Foo $x
*/
foreach ($items as $x) {
    $x->process();
}
