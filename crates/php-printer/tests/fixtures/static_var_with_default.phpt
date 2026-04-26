===source===
<?php function counter() {
    static $count = 0, $start, $list = [1, 2, 3];
    return ++$count;
}
===print===
function counter()
{
    static $count = 0, $start, $list = [1, 2, 3];
    return ++$count;
}
