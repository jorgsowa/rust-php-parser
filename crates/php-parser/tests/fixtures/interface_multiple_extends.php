<?php
interface ReadWrite extends Readable, Writable {
    public function flush(): void;
}
