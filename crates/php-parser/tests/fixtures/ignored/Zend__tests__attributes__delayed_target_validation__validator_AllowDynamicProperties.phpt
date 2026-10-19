===config===
ignore=DelayedTargetValidation suppresses attribute target errors
min_php=8.5
===source===
<?php

#[DelayedTargetValidation]
#[AllowDynamicProperties]
trait DemoTrait {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
interface DemoInterface {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
readonly class DemoReadonly {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
enum DemoEnum {}

$cases = [
	new ReflectionClass('DemoTrait'),
	new ReflectionClass('DemoInterface'),
	new ReflectionClass('DemoReadonly'),
	new ReflectionClass('DemoEnum'),
];
foreach ($cases as $r) {
	echo str_repeat("*", 20) . "\n";
	echo $r . "\n";
	$attributes = $r->getAttributes();
	var_dump($attributes);
	try {
		$attributes[1]->newInstance();
	} catch (Error $e) {
		echo get_class($e) . ": " . $e->getMessage() . "\n";
	}
}

?>
