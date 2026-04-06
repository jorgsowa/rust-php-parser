===source===
<?php
function &getRef() {
    static $val = 0;
    return $val;
}
