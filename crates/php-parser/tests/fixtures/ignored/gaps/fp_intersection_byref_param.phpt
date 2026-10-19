===config===
ignore=parser rejects valid code: intersection type before a by-ref param
===source===
<?php
function f(A&B &$x) {}
===ast >=8.5===
