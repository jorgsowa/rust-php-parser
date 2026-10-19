===config===
ignore=virtual hooked property default is checked at inheritance when the class has a parent
min_php=8.5
===source===
<?php

class Test {
    public $addedHooks = 'addedHooks';
    public $virtual {
        get { return strtoupper('virtual'); }
    }
    public $backed = 'backed' {
        get { return strtoupper($this->backed); }
        set { $this->backed = $value; }
    }
    public $writeOnly {
        set {}
    }
    private $private = 'private' {
        get { return strtoupper($this->private); }
        set { $this->private = $value; }
    }
    private $changed = 'changed Test' {
        get { return strtoupper($this->changed); }
    }
    public function dumpTest() {
        var_dump($this);
        var_dump(get_object_vars($this));
        var_dump(get_mangled_object_vars($this));
        var_export($this);
        echo "\n";
        echo json_encode($this), "\n";
        var_dump((array) $this);
    }
}

class Child extends Test {
    public $addedHooks = 'addedHooks' {
        get { return strtoupper(parent::$addedHooks::get()); }
    }
    private $changed = 'changed Child' {
        get { return strtoupper($this->changed); }
    }
    public function dumpChild() {
        var_dump($this);
        var_dump(get_object_vars($this));
        var_export($this);
        echo "\n";
        echo json_encode($this), "\n";
        var_dump((array) $this);
    }
}

function dump($test) {
    var_dump($test);
    var_dump(get_object_vars($test));
    var_export($test);
    echo "\n";
    echo json_encode($test), "\n";
    var_dump((array) $test);
}

echo "dump(Test):\n";
dump(new Test);

echo "\n\ndump(Child):\n";
dump(new Child);

echo "\n\nChild::dumpTest():\n";
(new Child)->dumpTest();

echo "\n\nChild::dumpChild():\n";
(new Child)->dumpChild();

?>
