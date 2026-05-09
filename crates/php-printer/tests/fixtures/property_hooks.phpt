===source===
<?php class User {
    public string $name {
        get => strtoupper($this->name);
        set(string $value) {
            $this->name = trim($value);
        }
    }

    public string $email {
        get { return $this->email; }
        set { $this->email = $value; }
    }

    public string $description {
        get => $this->description;
        set { $this->description = $value; }
    }

    public string $status = 'active' {
        get => strtoupper($this->status);
    }

    public int $count {
        get { return $this->count; }
        set { $this->count = max(0, $value); }
    }

    public string $fullName {
        get => $this->firstName . ' ' . $this->lastName;
    }
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
        get {
            return $this->email;
        }
        set {
            $this->email = $value;
        }
    }

    public string $description {
        get => $this->description;
        set {
            $this->description = $value;
        }
    }

    public string $status = 'active' {
        get => strtoupper($this->status);
    }

    public int $count {
        get {
            return $this->count;
        }
        set {
            $this->count = max(0, $value);
        }
    }

    public string $fullName {
        get => $this->firstName . ' ' . $this->lastName;
    }
}
