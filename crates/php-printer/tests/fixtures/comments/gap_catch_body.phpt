===source===
<?php
try {
    echo 1;
} catch (Exception $e)
// comment before catch block
{
    echo 2;
}
===print===
<?php
try {
    echo 1;
} catch (Exception $e)
// comment before catch block
{
    echo 2;
}
