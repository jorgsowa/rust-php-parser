===source===
<?php
$value = $x ?? throw new InvalidArgumentException('Missing value');
$result = match ($status) {
    200 => 'ok',
    default => throw new RuntimeException('Unexpected status'),
};
