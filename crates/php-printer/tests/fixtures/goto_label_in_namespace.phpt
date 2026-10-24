===source===
<?php namespace App; start: foo(); goto start;
===print===
<?php
namespace App;

start:
foo();
goto start;
