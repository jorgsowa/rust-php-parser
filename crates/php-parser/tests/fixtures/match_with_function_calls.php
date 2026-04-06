<?php
$label = match (getStatus()) {
    isActive() => 'active',
    isPending() => 'pending',
    default => throw new LogicException('Unknown'),
};
