===source===
<?php
enum Suit: string
{
    case Hearts = 'H';

    const TOTAL = 4;

    public const string LABEL = 'suit';

    public function label(): string
    {
        return $this->value;
    }
}
===print===
enum Suit: string
{
    case Hearts = 'H';

    const TOTAL = 4;

    public const string LABEL = 'suit';

    public function label(): string
    {
        return $this->value;
    }
}
