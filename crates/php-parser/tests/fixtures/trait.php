<?php
trait Timestampable {
    public function getCreatedAt(): string {
        return $this->createdAt;
    }
}
class Post {
    use Timestampable;
    public string $title;
}
