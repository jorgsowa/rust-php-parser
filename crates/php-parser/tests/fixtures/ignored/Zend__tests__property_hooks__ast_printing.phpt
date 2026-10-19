===config===
ignore=PHP skips compile errors inside assert(false && ...)
min_php=8.5
===source===
<?php

try {
    assert(false && new class {
        public $prop1 { get; set; }
        public $prop2 {
            get {
                return parent::$prop1::get();
            }
            final set {
                echo 'Foo';
                $this->prop1 = 42;
            }
        }
        public $prop3 = 1 {
            get => 42;
        }
    });
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

?>
