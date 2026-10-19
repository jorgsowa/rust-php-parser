===config===
ignore=non-fatal warning: final private method
min_php=8.5
===source===
<?php
class A {
    function callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    function notOverridden_callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    private function normalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
    final private function finalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
}
class B extends A {
    function callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    private function normalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
    final private function finalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
}
$a = new A();
$a->callYourPrivates();
$a->notOverridden_callYourPrivates();
$b = new B();
$b->callYourPrivates();
$b->notOverridden_callYourPrivates();
?>
