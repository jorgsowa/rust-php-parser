===source===
<?php
function f() {
    return <<<EOT
        indented $x
          more
        EOT;
}
class A {
    const X = <<<'EOT'
        a
         b
        EOT;
}
===print===
<?php
function f()
{
    return <<<EOT
indented $x
  more
EOT;
}

class A
{
    const X = <<<'EOT'
a
 b
EOT;
}
