===config===
min_php=8.4
===source===
<?php
class Foo {
    public string $name {
        get => strtoupper($this->name);
        set(string $value) => strtolower($value);
    }
    public int $count {
        get { return $this->count; }
        set { $this->count = max(0, $value); }
    }
    public int $id {
        &get { return $this->id; }
    }
}
