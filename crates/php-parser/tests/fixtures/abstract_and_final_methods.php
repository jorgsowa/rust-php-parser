<?php
abstract class Base {
    abstract protected function template(): string;
    final public function execute(): void {
        echo $this->template();
    }
}
