===config===
ignore=non-fatal warning: non-public magic method
min_php=8.5
===source===
<?php

class foo {
    private function __unset($a) {
        print "unset\n";
    }
}

?>
