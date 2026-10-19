===config===
ignore=DelayedTargetValidation suppresses attribute target errors
min_php=8.5
===source===
<?php

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
class DemoClass {
	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public $val;

	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does nothing here
	public const CLASS_CONST = 'FOO';

	public function __construct(
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		$str
	) {
		echo "Got: $str\n";
		$this->val = $str;
	}

	#[DelayedTargetValidation]
	#[NoDiscard] // Does something here
	public function printVal() {
		echo 'Value is: ' . $this->val . "\n";
		return 123;
	}
}

#[DelayedTargetValidation]
#[NoDiscard] // Does something here
function demoFn() {
	echo __FUNCTION__ . "\n";
	return 456;
}

#[DelayedTargetValidation]
#[NoDiscard] // Does nothing here
const GLOBAL_CONST = 'BAR';

$d = new DemoClass('example');
$d->printVal();
$v = $d->printVal();
var_dump($d->val);
$d->hooked = "foo";
var_dump($d->hooked);
// NoDiscard does not support property hooks, this should not complain
$d->hooked;
var_dump(DemoClass::CLASS_CONST);
demoFn();
$v = demoFn();
var_dump(GLOBAL_CONST);
?>
