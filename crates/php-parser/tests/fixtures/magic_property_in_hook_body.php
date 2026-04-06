<?php
class Foo {
    public string $name {
        get {
            echo __PROPERTY__;
            return $this->name;
        }
    }
}
