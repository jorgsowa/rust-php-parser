===config===
ignore=non-fatal warning: non-public magic method
min_php=8.5
===source===
<?php

class a {
    static protected function __callstatic($a, $b) {
    }
}

?>
