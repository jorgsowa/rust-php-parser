===config===
ignore=DelayedTargetValidation suppresses attribute target errors
min_php=8.5
===source===
<?php

#[DelayedTargetValidation]
#[Deprecated] // Does nothing here
class DemoClass {
	#[DelayedTargetValidation]
	#[Deprecated] // Does nothing here
	public $val;

	public string $hooked {
		#[DelayedTargetValidation]
		#[Deprecated] // Does something here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[Deprecated] // Does something here
		set => $value;
	}

	#[DelayedTargetValidation]
	#[Deprecated] // Does something here
	public const CLASS_CONST = 'FOO';

	public function __construct(
		#[DelayedTargetValidation]
		#[Deprecated] // Does nothing here
		$str
	) {
		echo "Got: $str\n";
		$this->val = $str;
	}

	#[DelayedTargetValidation]
	#[Deprecated] // Does something here
	public function printVal() {
		echo 'Value is: ' . $this->val . "\n";
		return 123;
	}
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
trait DeprecatedTrait {}

class WithDeprecatedTrait {
	use DeprecatedTrait;
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
function demoFn() {
	echo __FUNCTION__ . "\n";
	return 456;
}

#[DelayedTargetValidation]
#[Deprecated] // Does something here
const GLOBAL_CONST = 'BAR';

$d = new DemoClass('example');
$d->printVal();
var_dump($d->val);
$d->hooked = "foo";
var_dump($d->hooked);
var_dump(DemoClass::CLASS_CONST);
demoFn();
var_dump(GLOBAL_CONST);
?>
