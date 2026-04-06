===source===
<?php
interface Loggable {
    public function log(): void;
}
interface Serializable {
    public function serialize(): string;
}
class User extends Model implements Loggable, Serializable {
    public function log(): void {}
    public function serialize(): string {
        return '';
    }
}
