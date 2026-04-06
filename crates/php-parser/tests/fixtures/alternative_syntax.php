<?php
if ($x > 0):
    echo 'positive';
elseif ($x < 0):
    echo 'negative';
else:
    echo 'zero';
endif;
while ($i < 5):
    echo $i;
    $i++;
endwhile;
for ($i = 0; $i < 3; $i++):
    echo $i;
endfor;
foreach ($items as $item):
    echo $item;
endforeach;
switch ($color):
    case 'red':
        echo 'red';
        break;
    default:
        echo 'other';
endswitch;
