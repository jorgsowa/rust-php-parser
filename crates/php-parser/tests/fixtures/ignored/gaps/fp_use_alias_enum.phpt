===config===
ignore=parser rejects valid code: `enum` as a use alias
===source===
<?php
use A as enum;
===ast >=8.5===
