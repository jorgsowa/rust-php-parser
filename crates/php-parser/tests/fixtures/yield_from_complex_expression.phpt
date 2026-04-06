===source===
<?php
function gen() {
    yield from array_map(fn($x) => $x * 2, [1, 2, 3]);
}
