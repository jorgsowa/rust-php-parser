===config===
ignore=non-fatal warning: use with a non-compound name
min_php=8.5
===source===
<?php

namespace {
    class C {}
    var_dump(new C);
}

namespace Ns {
    class C {}
    var_dump(new C);
}

namespace {
    use Ns\C;
    var_dump(new C);
}

namespace Ns {
    use C;
    var_dump(new C);
}

namespace {
    var_dump(new C);
}

namespace Ns {
    var_dump(new C);
}

namespace {
    use C;
    var_dump(new C);
}

namespace Ns {
    use Ns\C;
    var_dump(new C);
}

?>
