===source===
<?php
try {
    echo 1;
}
// comment between } and finally
finally
// comment between finally and {
{
    echo 2;
}
===print===
<?php
try {
    echo 1;
}
// comment between } and finally
finally
// comment between finally and {
{
    echo 2;
}
