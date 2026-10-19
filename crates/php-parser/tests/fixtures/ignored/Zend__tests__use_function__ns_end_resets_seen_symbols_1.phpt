===config===
ignore=non-fatal warning: use with a non-compound name
min_php=8.5
===source===
<?php

namespace {
    function f() {
        echo __FUNCTION__, "\n";
    }
    f();
}

namespace Ns {
    function f() {
        echo __FUNCTION__, "\n";
    }
    f();
}

namespace {
    use function Ns\f;
    f();
}

namespace Ns {
    use function f;
    f();
}

namespace {
    f();
}

namespace Ns {
    f();
}

namespace {
    use function f;
    f();
}

namespace Ns {
    use function Ns\f;
    f();
}

?>
