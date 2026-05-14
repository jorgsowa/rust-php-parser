===source===
<?php
enum Status: string
{
    case Active = 'active';


    case Inactive = 'inactive';

    public function label(): string
    {
        return $this->value;
    }
}
===print===
<?php
enum Status: string
{
    case Active = 'active';

    case Inactive = 'inactive';

    public function label(): string
    {
        return $this->value;
    }
}
