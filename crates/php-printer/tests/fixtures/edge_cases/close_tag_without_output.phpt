===source===
<?php echo 1; ?>
<?php echo 2 ?>
<?php if ($a): ?>
<?php endif ?>
<?php echo 3; ?>
===print===
<?php
echo 1;
echo 2;
if ($a):

endif;
echo 3;
