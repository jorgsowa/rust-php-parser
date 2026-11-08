===source===
<?php
C::public( set );
C::protected( set );
C::private ( SET );
$o::PUBLIC( set );
C::public( \set );
C::public( set, 1 );
C::public();
C::static( set );
$o->public( set );
===print===
<?php
C::public (set);
C::protected (set);
C::private (SET);
$o::PUBLIC (set);
C::public(\set);
C::public(set, 1);
C::public();
C::static(set);
$o->public(set);
