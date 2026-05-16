===source===
<?php
// PHP: (int)($a ** 2). ** binds tighter than cast.
STATUS: parser correct (cast operand parse uses bp 41, ** has left_bp 60). Pinned.
(int)$a ** 2;
