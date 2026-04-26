===source===
<?php class User {
    public string $name {
        get => strtoupper($this->name);
        set(string $value) {
            $this->name = trim($value);
        }
    }

    public string $email { get; set; }
}
===print===
class User
{
    public string $name {
        get => strtoupper($this->name);
        set(string $value) {
            $this->name = trim($value);
        }
    }

    public string $email {
        get;
        set;
    }
}
