===source===
<?php
$x = match ($status) {
    200 => 'ok',
    404 => throw new NotFoundException(),
    default => throw new RuntimeException('Unexpected'),
};
