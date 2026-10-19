===config===
ignore=DelayedTargetValidation suppresses attribute target errors
min_php=8.5
===source===
<?php

class DemoClass {
	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}
}

$cases = [
	new ReflectionProperty('DemoClass', 'hooked')->getHook(PropertyHookType::Get),
	new ReflectionProperty('DemoClass', 'hooked')->getHook(PropertyHookType::Set),
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
