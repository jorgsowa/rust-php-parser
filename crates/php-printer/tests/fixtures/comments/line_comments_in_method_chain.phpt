===source===
<?php
return $uri
    // first
    ->when(1)
    // second
    ?->when(cb: function ($u) {
        return $u;
    })
    // third
    ->prop;
if ($a
    // before operator
    && $b->c()) {}
===print===
<?php
return $uri
    // first
    ->when(1)
    // second
    ?->when(cb: function($u) {
        return $u;
    })
    // third
    ->prop;
if ($a && $b->c())
// before operator
{}
