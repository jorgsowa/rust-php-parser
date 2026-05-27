===source===
<?php
$x = match ($y)
// comment between match (...) and {
{
    1 => 'one',
    default => 'other',
};
===print===
<?php
$x = match ($y)
// comment between match (...) and {
{
    1 => 'one',
    default => 'other',
};
