===source===
<?php
// PHP: (clone $a) + 1. clone binds tighter than +.
STATUS: parser correct (clone uses bp 41 > + bp 35). Pinned.
clone $a + 1;
