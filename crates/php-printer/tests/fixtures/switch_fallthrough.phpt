===source===
<?php switch ($x) {
    case 1:
    case 2:
    case 3:
        doSomething();
        break;
    case 4:
        other();
        break;
    default:
}
===print===
switch ($x) {
case 1:
case 2:
case 3:
    doSomething();
    break;
case 4:
    other();
    break;
default:
}
