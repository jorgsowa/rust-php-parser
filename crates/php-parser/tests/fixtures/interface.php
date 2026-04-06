===source===
<?php
interface HasId {
    public function getId(): int;
}
interface HasName extends HasId {
    public function getName(): string;
}
