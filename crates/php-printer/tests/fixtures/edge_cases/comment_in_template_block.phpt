===source===
<?php
function t() {
    ?>
<div>
<?php // comment ?>
    <p>text</p>
<?php
}
===print===
<?php
function t()
{
    ?>
<div>
<?php
    // comment
    ?>
    <p>text</p>
<?php
}
