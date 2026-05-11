===source===
<?php enum Status { public final const PUB_FIN = 1; protected final const PROT_FIN = 2; private const PRIV = 3; }
===print===
<?php
enum Status
{
    final public const PUB_FIN = 1;

    final protected const PROT_FIN = 2;

    private const PRIV = 3;
}
