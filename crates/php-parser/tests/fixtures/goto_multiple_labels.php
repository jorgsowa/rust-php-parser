<?php
if ($a) goto labelA;
if ($b) goto labelB;
labelA:
echo 'A';
goto end;
labelB:
echo 'B';
end:
echo 'done';
