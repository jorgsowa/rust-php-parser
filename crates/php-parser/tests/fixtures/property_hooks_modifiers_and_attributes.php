<?php
abstract class Foo {
    abstract public int $abstract_prop {
        get;
        set;
    }
    public int $final_prop {
        final get { return 42; }
        final set(int $value) { $this->final_prop = $value; }
    }
    public int $attr_prop {
        #[Cache]
        get { return $this->compute(); }
        #[Validate]
        set(int $value) { $this->attr_prop = $value; }
    }
}
