===source===
<?php
enum E { case A; use X; /* end */ }
===print===
<?php
enum E
{
    use X; /* end */

    case A;
}
