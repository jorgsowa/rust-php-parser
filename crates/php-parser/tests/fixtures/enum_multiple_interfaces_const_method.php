<?php
enum Status: string implements Loggable, Serializable {
    case Active = 'active';
    case Inactive = 'inactive';

    const DEFAULT = self::Active;

    public function label(): string {
        return $this->value;
    }

    public function isActive(): bool {
        return $this === self::Active;
    }
}
