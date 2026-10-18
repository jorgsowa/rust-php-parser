===source===
<?php namespace N { use A\{B, function d}; }
===print===
<?php
namespace N {
    use A\B;
    use function A\d;
}
