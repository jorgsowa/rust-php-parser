===source===
<?php
switch ($action) {
    case 'create':
        doA();
        doB();

    case 'update':
        doC();

    default:
        doD();
}
===print===
<?php
switch ($action) {
    case 'create':
        doA();
        doB();

    case 'update':
        doC();

    default:
        doD();
}
