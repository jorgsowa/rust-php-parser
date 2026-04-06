===source===
<?php
function combined() {
    yield from [1, 2, 3];
    yield from otherGenerator();
}
