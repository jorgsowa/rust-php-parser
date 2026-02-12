<?php

// Basic anonymous class
$obj = new class {};

// With constructor args
$obj = new class(1, 2) {};

// With extends
$obj = new class extends Foo {};

// With implements
$obj = new class implements Bar, Baz {};

// With members
$obj = new class {
    public $x = 10;
    public function hello() {
        return 'hi';
    }
};

// Full: constructor args + extends + implements + members
$obj = new class($x) extends Base implements Iface {
    private $val;
    public function __construct($val) {
        $this->val = $val;
    }
    public function getValue() {
        return $this->val;
    }
};
