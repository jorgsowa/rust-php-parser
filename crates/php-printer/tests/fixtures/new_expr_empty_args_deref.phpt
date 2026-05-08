===source===
<?php
new A()->prop;
new A()['key'];
new A()::CONST;
new A()();
new B(1)->prop;
new C()('arg');
===print===
new A()->prop;
new A()['key'];
new A()::CONST;
new A()();
new B(1)->prop;
new C()('arg');
