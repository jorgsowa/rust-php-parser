export interface NodeField {
  name: string
  type: string
  description: string
  optional?: boolean
}

export interface AstNode {
  id: string
  group: string
  name: string
  description: string
  phpExample: string
  fields?: NodeField[]
  phpVersion?: string
  keywordInExample?: string | string[]
  fieldHighlights?: Record<string, string[]>
}

export const astNodes: AstNode[] = [
  // ========== STATEMENTS ==========
  {
    id: 'stmt-block',
    group: 'Control Flow',
    name: 'Block',
    description: 'Block of statements',
    phpExample: `{\n  $x = 1;\n  echo $x;\n}`,
    keywordInExample: ['{', '}'],
    fieldHighlights: {
      stmts: ['$x = 1;', 'echo $x;']
    },
    fields: [
      { name: 'stmts', type: 'Vec<Stmt>', description: 'Statements in block' }
    ]
  },
  {
    id: 'stmt-break',
    group: 'Control Flow',
    name: 'Break',
    description: 'Break from loop or switch',
    phpExample: `while (true) {\n  if ($done) break;\n}\n\nfor ($i = 0; $i < 5; $i++) {\n  while (true) {\n    if ($done) break 2;\n  }\n}`,
    keywordInExample: 'break',
    fieldHighlights: {
      level: ['2']
    },
    fields: [
      { name: 'level', type: 'Option<Expr>', description: 'Number of levels to break', optional: true }
    ]
  },
  {
    id: 'stmt-class',
    group: 'Define Code',
    name: 'Class',
    description: 'Class declaration',
    phpExample: `#[Entity]\nfinal class Animal extends Base implements Countable {\n  public string $name;\n  public function speak(): void {}\n}`,
    keywordInExample: 'class',
    fieldHighlights: {
      name: ['Animal'],
      modifiers: ['final'],
      extends: ['extends Base'],
      implements: ['implements Countable'],
      members: ['public string $name;', 'public function speak(): void {}'],
      attributes: ['#[Entity]']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Class name' },
      { name: 'modifiers', type: 'ClassModifiers', description: 'Modifiers (abstract, final, readonly)' },
      { name: 'extends', type: 'Option<Name>', description: 'Parent class', optional: true },
      { name: 'implements', type: 'Vec<Name>', description: 'Interfaces' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Properties, methods, constants' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'PHP attributes (#[...])' }
    ]
  },
  {
    id: 'stmt-const',
    group: 'Define Code',
    name: 'Const',
    description: 'Global constant declaration',
    phpExample: `const MAX_SIZE = 100;\nconst DB_HOST = DB_DEFAULT_HOST;`,
    keywordInExample: 'const',
    fieldHighlights: {
      items: ['MAX_SIZE = 100', 'DB_HOST = DB_DEFAULT_HOST']
    },
    fields: [
      { name: 'items', type: 'Vec<ConstItem>', description: 'Constant declarations' }
    ]
  },
  {
    id: 'stmt-continue',
    group: 'Control Flow',
    name: 'Continue',
    description: 'Continue to next iteration of loop',
    phpExample: `for ($i = 0; $i != 10; $i++) {\n  if ($i < 0) continue;\n  echo $i;\n}\n\nfor ($i = 0; $i != 10; $i++) {\n  while (true) {\n    if ($done) continue 2;\n  }\n}`,
    keywordInExample: 'continue',
    fieldHighlights: {
      level: ['2']
    },
    fields: [
      { name: 'level', type: 'Option<Expr>', description: 'Number of levels to continue', optional: true }
    ]
  },
  {
    id: 'stmt-declare',
    group: 'Define Code',
    name: 'Declare',
    description: 'Declare directives like strict_types',
    phpExample: `declare(strict_types=1);\ndeclare(ticks=1) {}`,
    keywordInExample: 'declare',
    fieldHighlights: {
      directives: ['strict_types=1', 'ticks=1'],
      body: ['{}']
    },
    fields: [
      { name: 'directives', type: 'Vec<(str, Expr)>', description: 'Directives' },
      { name: 'body', type: 'Option<Stmt>', description: 'Declare body', optional: true }
    ]
  },
  {
    id: 'stmt-do-while',
    group: 'Control Flow',
    name: 'DoWhile',
    description: 'Do-while loop (executes at least once)',
    phpExample: `do {\n  echo $x;\n  $x--;\n} while ($x != 0);`,
    keywordInExample: ['do', 'while'],
    fieldHighlights: {
      body: ['echo $x;', '$x--;'],
      condition: ['$x != 0']
    },
    fields: [
      { name: 'body', type: 'Stmt', description: 'Loop body' },
      { name: 'condition', type: 'Expr', description: 'Loop condition' }
    ]
  },
  {
    id: 'stmt-echo',
    group: 'Output/Communication',
    name: 'Echo',
    description: 'Output one or more values',
    phpExample: `echo $greeting, $name, PHP_EOL;\necho "done";`,
    keywordInExample: 'echo',
    fieldHighlights: {
      exprs: ['$greeting', '$name', 'PHP_EOL', '"done"']
    },
    fields: [
      { name: 'exprs', type: 'Vec<Expr>', description: 'Values to output' }
    ]
  },
  {
    id: 'stmt-enum',
    group: 'Define Code',
    name: 'Enum',
    description: 'Enumeration declaration (PHP 8.1+)',
    phpExample: `enum Status: string implements Countable {\n  case Active = STATUS_ACTIVE;\n  case Inactive = STATUS_INACTIVE;\n}`,
    phpVersion: '8.1+',
    keywordInExample: 'enum',
    fieldHighlights: {
      name: ['Status'],
      scalar_type: ['string'],
      implements: ['implements Countable'],
      members: ['case Active = STATUS_ACTIVE;', 'case Inactive = STATUS_INACTIVE;']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Enum name' },
      { name: 'scalar_type', type: 'Option<Name>', description: 'Backing type (int or string)', optional: true },
      { name: 'implements', type: 'Vec<Name>', description: 'Implemented interfaces' },
      { name: 'members', type: 'Vec<EnumMember>', description: 'Cases and methods' }
    ]
  },
  {
    id: 'stmt-for',
    group: 'Control Flow',
    name: 'For',
    description: 'For loop with init/condition/update',
    phpExample: `for ($i = 0; $i != 10; $i++) {\n  echo $i;\n}`,
    keywordInExample: 'for',
    fieldHighlights: {
      init: ['$i = 0'],
      condition: ['$i != 10'],
      update: ['$i++'],
      body: ['echo $i;']
    },
    fields: [
      { name: 'init', type: 'Vec<Expr>', description: 'Initialization expressions' },
      { name: 'condition', type: 'Vec<Expr>', description: 'Loop conditions' },
      { name: 'update', type: 'Vec<Expr>', description: 'Update expressions' },
      { name: 'body', type: 'Stmt', description: 'Loop body' }
    ]
  },
  {
    id: 'stmt-foreach',
    group: 'Control Flow',
    name: 'Foreach',
    description: 'Foreach loop over an array or iterable',
    phpExample: `foreach ($arr as $key => $value) {\n  echo $key;\n  echo $value;\n}`,
    keywordInExample: 'foreach',
    fieldHighlights: {
      expr: ['$arr'],
      key: ['$key'],
      value: ['$value'],
      body: ['echo $key', 'echo $value']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Expression to iterate' },
      { name: 'key', type: 'Option<Expr>', description: 'Key variable', optional: true },
      { name: 'value', type: 'Expr', description: 'Value variable' },
      { name: 'body', type: 'Stmt', description: 'Loop body' }
    ]
  },
  {
    id: 'stmt-function',
    group: 'Define Code',
    name: 'Function',
    description: 'Function declaration',
    phpExample: `#[Route('/api')]\nfunction &greet(string $name): string {\n  return $name;\n}`,
    keywordInExample: 'function',
    fieldHighlights: {
      name: ['greet'],
      by_ref: ['&'],
      params: ['string $name'],
      return_type: ['string'],
      body: ['return $name'],
      attributes: ['#[Route(\'/api\')]']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Function name' },
      { name: 'by_ref', type: 'bool', description: 'Returns by reference (&function)' },
      { name: 'params', type: 'Vec<Param>', description: 'Function parameters' },
      { name: 'body', type: 'Vec<Stmt>', description: 'Function body' },
      { name: 'return_type', type: 'Option<TypeHint>', description: 'Return type', optional: true },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'PHP attributes (#[...])' }
    ]
  },
  {
    id: 'stmt-global',
    group: 'Define Code',
    name: 'Global',
    description: 'Declare global variables',
    phpExample: `function test() {\n  global $counter, $name;\n}`,
    keywordInExample: 'global',
    fieldHighlights: {
      vars: ['$counter', '$name']
    },
    fields: [
      { name: 'vars', type: 'Vec<Expr>', description: 'Variables to declare global' }
    ]
  },
  {
    id: 'stmt-goto',
    group: 'Define Code',
    name: 'Goto',
    description: 'Go to label',
    phpExample: `goto end;\necho $skipped;\nend:\necho $done;`,
    keywordInExample: 'goto',
    fieldHighlights: {
      label: ['end']
    },
    fields: [
      { name: 'label', type: 'Ident', description: 'Target label' }
    ]
  },
  {
    id: 'stmt-halt-compiler',
    group: 'Define Code',
    name: 'HaltCompiler',
    description: '__halt_compiler() — everything after is raw data ignored by PHP',
    phpExample: `__halt_compiler();\nThis data is ignored by PHP.`,
    keywordInExample: '__halt_compiler',
    fieldHighlights: {
      data: ['This data is ignored by PHP.']
    },
    fields: [
      { name: 'data', type: 'string', description: 'Raw data after __halt_compiler()' }
    ]
  },
  {
    id: 'stmt-if',
    group: 'Control Flow',
    name: 'If',
    description: 'Conditional statement with if/elseif/else branches',
    phpExample: `if ($x == 1) {\n  echo $positive;\n} elseif ($x == 2) {\n  echo $negative;\n} else {\n  echo $zero;\n}`,
    keywordInExample: 'if',
    fieldHighlights: {
      condition: ['$x == 1'],
      then_branch: ['{\n  echo $positive;\n}'],
      elseif_branches: ['elseif ($x == 2) {\n  echo $negative;\n}'],
      else_branch: ['else {\n  echo $zero;\n}']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Condition to evaluate' },
      { name: 'then_branch', type: 'Stmt', description: 'Statement when condition is true' },
      { name: 'elseif_branches', type: 'Vec<ElseIfBranch>', description: 'Elseif branches' },
      { name: 'else_branch', type: 'Option<Stmt>', description: 'Else statement', optional: true }
    ]
  },
  {
    id: 'stmt-inline-html',
    group: 'Output/Communication',
    name: 'InlineHtml',
    description: 'Inline HTML outside <?php ... ?>',
    phpExample: `<?php echo $php; ?>\nThis is HTML`,
    fieldHighlights: {
      html: ['This is HTML']
    },
    fields: [
      { name: 'html', type: 'string', description: 'HTML content' }
    ]
  },
  {
    id: 'stmt-interface',
    group: 'Define Code',
    name: 'Interface',
    description: 'Interface declaration',
    phpExample: `interface Drawable extends Countable {\n  public function draw(): void;\n}`,
    keywordInExample: 'interface',
    fieldHighlights: {
      name: ['Drawable'],
      extends: ['extends Countable'],
      members: ['public function draw(): void;']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Interface name' },
      { name: 'extends', type: 'Vec<Name>', description: 'Parent interfaces' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Methods' }
    ]
  },
  {
    id: 'stmt-label',
    group: 'Define Code',
    name: 'Label',
    description: 'Target point for goto statements',
    phpExample: `loop:\necho $counter;\ngoto loop;`,
    fieldHighlights: {
      name: ['loop']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Label name' }
    ]
  },
  {
    id: 'stmt-namespace',
    group: 'Define Code',
    name: 'Namespace',
    description: 'Namespace declaration',
    phpExample: `namespace App\\Utils {\n  function helper() {}\n  class Helper {}\n}\n\nnamespace {\n  $x = 1;\n}\n`,
    keywordInExample: 'namespace',
    fieldHighlights: {
      name: ['App\\Utils'],
      body: ['function helper() {}', 'class Helper {}', '$x = 1;']
    },
    fields: [
      { name: 'name', type: 'Option<Name>', description: 'Namespace name', optional: true },
      { name: 'body', type: 'NamespaceBody', description: 'Namespace contents' }
    ]
  },
  {
    id: 'stmt-nop',
    group: 'Define Code',
    name: 'Nop',
    description: 'Empty statement (;)',
    phpExample: `;`,
    fields: []
  },
  {
    id: 'stmt-return',
    group: 'Control Flow',
    name: 'Return',
    description: 'Return from a function or method',
    phpExample: `function add($a, $b) {\n  return $a + $b;\n}`,
    keywordInExample: 'return',
    fieldHighlights: {
      keyword: ['return'],
      value: ['$a + $b']
    },
    fields: [
      { name: 'value', type: 'Option<Expr>', description: 'Return value', optional: true }
    ]
  },
  {
    id: 'stmt-static-var',
    group: 'Define Code',
    name: 'StaticVar',
    description: 'Static variable declaration',
    phpExample: `function counter() {\n  static $count = 0, $max = 100;\n  return ++$count;\n}`,
    keywordInExample: 'static',
    fieldHighlights: {
      vars: ['$count = 0', '$max = 100']
    },
    fields: [
      { name: 'vars', type: 'Vec<StaticVar>', description: 'Static variables' }
    ]
  },
  {
    id: 'stmt-switch',
    group: 'Control Flow',
    name: 'Switch',
    description: 'Switch statement with cases and default',
    phpExample: `switch ($x) {\n  case 1:\n    $found = true;\n    break;\n  default:\n    echo $default;\n}`,
    keywordInExample: 'switch',
    fieldHighlights: {
      expr: ['$x'],
      cases: ['case 1:\n    $found = true;\n    break;', 'default:\n    echo $default;']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Value to switch on' },
      { name: 'cases', type: 'Vec<SwitchCase>', description: 'Switch cases' }
    ]
  },
  {
    id: 'stmt-throw',
    group: 'Control Flow',
    name: 'Throw',
    description: 'Throw an exception',
    phpExample: `try {\n  if ($invalid) {\n    throw new InvalidArgumentException($reason);\n  }\n} catch (InvalidArgumentException $e) {\n  echo $e->getMessage();\n}`,
    keywordInExample: 'throw',
    fieldHighlights: {
      exception: ['new InvalidArgumentException($reason)']
    },
    fields: [
      { name: 'exception', type: 'Expr', description: 'Exception to throw' }
    ]
  },
  {
    id: 'stmt-trait',
    group: 'Define Code',
    name: 'Trait',
    description: 'Trait declaration',
    phpExample: `trait Logger {\n  private string $name;\n\n  public function log($msg) { echo $msg; }\n}`,
    keywordInExample: 'trait',
    fieldHighlights: {
      name: ['Logger'],
      members: ['private string $name;', 'public function log($msg) { echo $msg; }']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Trait name' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Methods and properties' }
    ]
  },
  {
    id: 'stmt-try-catch',
    group: 'Control Flow',
    name: 'TryCatch',
    description: 'Try-catch-finally block',
    phpExample: `try {\n  $x = 1 / 0;\n} catch (DivisionByZeroError $e) {\n  echo $e->getMessage();\n} catch (Exception $e) {\n  echo "Error";\n} finally {\n  echo $done;\n}`,
    keywordInExample: 'try',
    fieldHighlights: {
      body: ['$x = 1 / 0'],
      catches: ['catch (DivisionByZeroError $e) {\n  echo $e->getMessage();\n}', 'catch (Exception $e) {\n  echo "Error";\n}'],
      finally: ['finally {\n  echo $done;\n}']
    },
    fields: [
      { name: 'body', type: 'Vec<Stmt>', description: 'Try block' },
      { name: 'catches', type: 'Vec<CatchClause>', description: 'Catch clauses' },
      { name: 'finally', type: 'Option<Vec<Stmt>>', description: 'Finally block', optional: true }
    ]
  },
  {
    id: 'stmt-unset',
    group: 'Control Flow',
    name: 'Unset',
    description: 'Unset variables',
    phpExample: `unset($a, $b, $arr[$key]);`,
    keywordInExample: 'unset',
    fieldHighlights: {
      vars: ['$a,', '$b,', '$arr[$key]']
    },
    fields: [
      { name: 'vars', type: 'Vec<Expr>', description: 'Variables to unset' }
    ]
  },
  {
    id: 'stmt-use',
    group: 'Define Code',
    name: 'Use',
    description: 'Use (import) statement',
    phpExample: `use App\\Models\\User;\nuse function Helper\\debug;\nuse const DB\\HOST;`,
    keywordInExample: 'use',
    fieldHighlights: {
      kind: ['function', 'const'],
      uses: ['App\\Models\\User', 'Helper\\debug', 'DB\\HOST']
    },
    fields: [
      { name: 'kind', type: 'UseKind', description: 'Type of use (Normal, Function, Const)' },
      { name: 'uses', type: 'Vec<UseItem>', description: 'Imported items' }
    ]
  },
  {
    id: 'stmt-while',
    group: 'Control Flow',
    name: 'While',
    description: 'While loop',
    phpExample: `while ($x != 0) {\n  echo $x;\n  $x--;\n}`,
    keywordInExample: 'while',
    fieldHighlights: {
      condition: ['$x != 0'],
      body: ['echo $x;', '$x--;']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Loop condition' },
      { name: 'body', type: 'Stmt', description: 'Loop body' }
    ]
  },
  // ========== EXPRESSIONS ==========
  {
    id: 'expr-anonymous-class',
    group: 'Class/Object Operations',
    name: 'AnonymousClass',
    description: 'Anonymous class instance (inline class definition)',
    phpExample: `new class extends Base implements Countable {\n  private string $value;\n\n  public function method() {}\n}`,
    keywordInExample: 'class',
    fieldHighlights: {
      extends: ['extends Base'],
      implements: ['implements Countable'],
      members: ['private string $value;', 'public function method() {}']
    },
    fields: [
      { name: 'extends', type: 'Option<Name>', description: 'Parent class', optional: true },
      { name: 'implements', type: 'Vec<Name>', description: 'Interfaces' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Properties and methods' }
    ]
  },
  {
    id: 'expr-array',
    group: 'Variables & Values',
    name: 'Array',
    description: 'Array literal',
    phpExample: `[1, 2, 3];\n[$a => $x, $b => $y];\narray(...$items);`,
    keywordInExample: 'array',
    fieldHighlights: {
      elements: ['1', '2', '3', '$a => $x', '$b => $y', '...$items']
    },
    fields: [
      { name: 'elements', type: 'Vec<ArrayElement>', description: 'Array elements' }
    ]
  },
  {
    id: 'expr-array-access',
    group: 'Operations',
    name: 'ArrayAccess',
    description: 'Array element access',
    phpExample: `$arr[0];\n$arr[$key];\n$arr[];`,
    fieldHighlights: {
      array: ['$arr'],
      index: ['0', '$key']
    },
    fields: [
      { name: 'array', type: 'Expr', description: 'Array expression' },
      { name: 'index', type: 'Option<Expr>', description: 'Index (None for append)', optional: true }
    ]
  },
  {
    id: 'expr-arrow-function',
    group: 'Function/Method Calls',
    name: 'ArrowFunction',
    description: 'Arrow function (short closure, PHP 7.4+)',
    phpExample: `#[Pure]\nstatic fn&(int $x): int => $x * $x;\nfn($a, $b): string => $a . $b;`,
    phpVersion: '7.4+',
    keywordInExample: 'fn',
    fieldHighlights: {
      is_static: ['static'],
      by_ref: ['&'],
      params: ['int $x', '$a, $b'],
      return_type: ['int', 'string'],
      body: ['$x * $x', '$a . $b'],
      attributes: ['#[Pure]']
    },
    fields: [
      { name: 'is_static', type: 'bool', description: 'Is static' },
      { name: 'by_ref', type: 'bool', description: 'Returns by reference' },
      { name: 'params', type: 'Vec<Param>', description: 'Parameters' },
      { name: 'return_type', type: 'Option<TypeHint>', description: 'Return type', optional: true },
      { name: 'body', type: 'Expr', description: 'Function body (expression)' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'PHP attributes (#[...])' }
    ]
  },
  {
    id: 'expr-assign',
    group: 'Operations',
    name: 'Assign',
    description: 'Assignment and compound assignments',
    phpExample: `$x = 10;\n$x += 5;\n$ref =& $original;\n$result ??= $default;`,
    fieldHighlights: {
      target: ['$x', '$ref', '$result'],
      op: ['+=', '=&', '??='],
      value: ['10', '5', '$original', '$default'],
      by_ref: ['=&']
    },
    fields: [
      { name: 'target', type: 'Expr', description: 'Assignment target' },
      { name: 'op', type: 'AssignOp', description: 'Assignment operator (=, +=, .=, etc)' },
      { name: 'value', type: 'Expr', description: 'Value to assign' },
      { name: 'by_ref', type: 'bool', description: 'Reference assignment ($a =& $b)' }
    ]
  },
  {
    id: 'expr-binary',
    group: 'Operations',
    name: 'Binary',
    description: 'Binary operation',
    phpExample: `$sum = $a + $b;\n$cmp = $x <=> $y;\n$obj instanceof MyClass;`,
    fieldHighlights: {
      left: ['$a', '$x', '$obj'],
      op: ['+', '<=>', 'instanceof'],
      right: ['$b', '$y', 'MyClass']
    },
    fields: [
      { name: 'left', type: 'Expr', description: 'Left operand' },
      { name: 'op', type: 'BinaryOp', description: 'Binary operator' },
      { name: 'right', type: 'Expr', description: 'Right operand' }
    ]
  },
  {
    id: 'expr-bool',
    group: 'Variables & Values',
    name: 'Bool',
    description: 'Boolean literal',
    phpExample: `$yes = true;\n$no = false;`,
    keywordInExample: ['true', 'false'],
    fieldHighlights: {
      value: ['true', 'false']
    },
    fields: [
      { name: 'value', type: 'bool', description: 'Boolean value' }
    ]
  },
  {
    id: 'expr-callable-create',
    group: 'Function/Method Calls',
    name: 'CallableCreate',
    description: 'Callable creation expression (first-class callables)',
    phpExample: `$func = strlen(...);\n$method = $obj->method(...);\n$static = MyClass::staticMethod(...);`,
    phpVersion: '8.1+',
    fieldHighlights: {
      kind: ['strlen(...)', '$obj->method(...)', 'MyClass::staticMethod(...)']
    },
    fields: [
      { name: 'kind', type: 'CallableCreateKind', description: 'Type of callable (function, method, static)' }
    ]
  },
  {
    id: 'expr-cast',
    group: 'Operations',
    name: 'Cast',
    description: 'Type cast',
    phpExample: `(int)$x;\n(string)$val;\n(array)$obj;`,
    fieldHighlights: {
      kind: ['(int)', '(string)', '(array)'],
      operand: ['$x', '$val', '$obj']
    },
    fields: [
      { name: 'kind', type: 'CastKind', description: 'Cast type (int, string, array, etc)' },
      { name: 'operand', type: 'Expr', description: 'Expression to cast' }
    ]
  },
  {
    id: 'expr-class-const',
    group: 'Class/Object Operations',
    name: 'ClassConstAccess',
    description: 'Class constant access',
    phpExample: `MyClass::VERSION;\nMyClass::MY_CONST;`,
    fieldHighlights: {
      class: ['MyClass'],
      member: ['VERSION', 'MY_CONST']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'member', type: 'Expr', description: 'Constant name' }
    ]
  },
  {
    id: 'expr-class-const-dyn',
    group: 'Class/Object Operations',
    name: 'ClassConstAccessDynamic',
    description: 'Dynamic class constant access (Foo::{expr})',
    phpExample: `$const = $version;\nFoo::{$const};`,
    phpVersion: '8.3+',
    fieldHighlights: {
      class: ['Foo'],
      member: ['{$const}']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'member', type: 'Expr', description: 'Dynamic member expression' }
    ]
  },
  {
    id: 'expr-clone',
    group: 'Class/Object Operations',
    name: 'Clone',
    description: 'Clone an object',
    phpExample: `$copy = clone $original;`,
    keywordInExample: 'clone',
    fieldHighlights: {
      object: ['$original']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object to clone' }
    ]
  },
  {
    id: 'expr-clone-with',
    group: 'Class/Object Operations',
    name: 'CloneWith',
    description: 'Clone with property overrides (PHP 8.5+)',
    phpExample: `clone($obj, id: $newId, status: "active");`,
    phpVersion: '8.5+',
    keywordInExample: 'clone',
    fieldHighlights: {
      object: ['$obj'],
      properties: ['id: $newId', 'status: "active"']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object to clone' },
      { name: 'properties', type: 'Vec<PropertyPair>', description: 'Property overrides' }
    ]
  },
  {
    id: 'expr-closure',
    group: 'Function/Method Calls',
    name: 'Closure',
    description: 'Anonymous function (closure)',
    phpExample: `#[Pure]\nstatic function&(int $a, int $b) use (&$multiplier): float {\n  return ($a + $b) * $multiplier;\n}`,
    keywordInExample: 'function',
    fieldHighlights: {
      is_static: ['static'],
      by_ref: ['&'],
      params: ['int $a', 'int $b'],
      use_vars: ['use (&$multiplier)'],
      return_type: ['float'],
      body: ['return ($a + $b) * $multiplier;'],
      attributes: ['#[Pure]']
    },
    fields: [
      { name: 'is_static', type: 'bool', description: 'Is static closure' },
      { name: 'by_ref', type: 'bool', description: 'Returns by reference' },
      { name: 'params', type: 'Vec<Param>', description: 'Parameters' },
      { name: 'use_vars', type: 'Vec<ClosureUseVar>', description: 'Use variables' },
      { name: 'return_type', type: 'Option<TypeHint>', description: 'Return type', optional: true },
      { name: 'body', type: 'Vec<Stmt>', description: 'Function body' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'PHP attributes (#[...])' }
    ]
  },
  {
    id: 'expr-empty',
    group: 'Other Expressions',
    name: 'Empty',
    description: 'Check if variable is empty',
    phpExample: `empty($var);\nif (empty($str)) {}`,
    keywordInExample: 'empty',
    fieldHighlights: {
      var: ['$var', '$str']
    },
    fields: [
      { name: 'var', type: 'Expr', description: 'Variable to check' }
    ]
  },
  {
    id: 'expr-error-suppress',
    group: 'Other Expressions',
    name: 'ErrorSuppress',
    description: 'Error suppression operator (@)',
    phpExample: `@file_get_contents($path);\n@$arr[$key];`,
    keywordInExample: '@',
    fieldHighlights: {
      operand: ['file_get_contents($path)', '$arr[$key]']
    },
    fields: [
      { name: 'operand', type: 'Expr', description: 'Expression to suppress' }
    ]
  },
  {
    id: 'expr-eval',
    group: 'Other Expressions',
    name: 'Eval',
    description: 'Evaluate PHP code',
    phpExample: `eval($code);`,
    keywordInExample: 'eval',
    fieldHighlights: {
      code: ['$code']
    },
    fields: [
      { name: 'code', type: 'Expr', description: 'Code to evaluate' }
    ]
  },
  {
    id: 'expr-exit',
    group: 'Output/Communication',
    name: 'Exit',
    description: 'Exit/die construct',
    phpExample: `exit($message);\ndie(1);`,
    keywordInExample: ['exit', 'die'],
    fieldHighlights: {
      value: ['$message', '1']
    },
    fields: [
      { name: 'value', type: 'Option<Expr>', description: 'Exit code or message', optional: true }
    ]
  },
  {
    id: 'expr-float',
    group: 'Variables & Values',
    name: 'Float',
    description: 'Float literal',
    phpExample: `$pi = 3.14;\n$exp = 1.5e3;`,
    fieldHighlights: {
      value: ['3.14', '1.5e3']
    },
    fields: [
      { name: 'value', type: 'f64', description: 'Float value' }
    ]
  },
  {
    id: 'expr-function-call',
    group: 'Function/Method Calls',
    name: 'FunctionCall',
    description: 'Function call',
    phpExample: `strlen($str);\narray_map(fn($x) => $x * 2, $arr);`,
    fieldHighlights: {
      name: ['strlen', 'array_map'],
      args: ['$str', 'fn($x) => $x * 2', '$arr']
    },
    fields: [
      { name: 'name', type: 'Expr', description: 'Function name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-heredoc',
    group: 'Variables & Values',
    name: 'Heredoc',
    description: 'Heredoc string with interpolation',
    phpExample: `$str = <<<EOT\n  Hello $name!\nEOT;\n\n$msg = <<<'EOD'\n  Static text\nEOD;`,
    keywordInExample: '<<<',
    fieldHighlights: {
      label: ['EOT', 'EOD'],
      parts: ['Hello ', '$name', '!', 'Static text']
    },
    fields: [
      { name: 'label', type: 'string', description: 'Heredoc label' },
      { name: 'parts', type: 'Vec<StringPart>', description: 'String parts (text and variables)' }
    ]
  },
  {
    id: 'expr-identifier',
    group: 'Variables & Values',
    name: 'Identifier',
    description: 'Bare name used as an expression (function name in a call, class name, etc.)',
    phpExample: `strlen($str);\nMyClass::method();`,
    keywordInExample: 'strlen',
    fieldHighlights: {
      name: ['strlen', 'MyClass']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Identifier name' }
    ]
  },
  {
    id: 'expr-include',
    group: 'Other Expressions',
    name: 'Include',
    description: 'Include/require files',
    phpExample: `include $header;\ninclude_once $once;\nrequire $config;\nrequire_once $loader;`,
    fieldHighlights: {
      kind: ['include_once', 'include', 'require_once', 'require'],
      file: ['$header', '$once', '$config', '$loader']
    },
    fields: [
      { name: 'kind', type: 'IncludeKind', description: 'Include/require/once variant' },
      { name: 'file', type: 'Expr', description: 'File path' }
    ]
  },
  {
    id: 'expr-int',
    group: 'Variables & Values',
    name: 'Int',
    description: 'Integer literal',
    phpExample: `$x = 42;\n$hex = 0xFF;\n$bin = 0b1010;`,
    fieldHighlights: {
      value: ['42', '0xFF', '0b1010']
    },
    fields: [
      { name: 'value', type: 'i64', description: 'Integer value' }
    ]
  },
  {
    id: 'expr-interpolated-string',
    group: 'Variables & Values',
    name: 'InterpolatedString',
    description: 'Double-quoted string with variable interpolation',
    phpExample: `"Hello $name";\n"Result: {$obj->prop}";`,
    fieldHighlights: {
      parts: ['Hello ', '$name', 'Result: ', '$obj->prop']
    },
    fields: [
      { name: 'parts', type: 'Vec<StringPart>', description: 'String parts (literals and expressions)' }
    ]
  },
  {
    id: 'expr-isset',
    group: 'Other Expressions',
    name: 'Isset',
    description: 'Check if variables are set',
    phpExample: `isset($var);\nisset($arr[$key], $obj->prop);`,
    keywordInExample: 'isset',
    fieldHighlights: {
      vars: ['$var', '$arr[$key]', '$obj->prop']
    },
    fields: [
      { name: 'vars', type: 'Vec<Expr>', description: 'Variables to check' }
    ]
  },
  {
    id: 'expr-magic-const',
    group: 'Variables & Values',
    name: 'MagicConst',
    description: 'Magic constant (__LINE__, __FILE__, etc)',
    phpExample: `__LINE__;\n__FILE__;\n__DIR__;\n__FUNCTION__;\n__CLASS__;\n__TRAIT__;\n__METHOD__;\n__NAMESPACE__;`,
    keywordInExample: ['__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__TRAIT__', '__METHOD__', '__NAMESPACE__'],
    fieldHighlights: {
      kind: ['__LINE__', '__FILE__', '__DIR__', '__FUNCTION__', '__CLASS__', '__TRAIT__', '__METHOD__', '__NAMESPACE__']
    },
    fields: [
      { name: 'kind', type: 'MagicConstKind', description: 'Magic constant type' }
    ]
  },
  {
    id: 'expr-match',
    group: 'Other Expressions',
    name: 'Match',
    description: 'Match expression (PHP 8.0+)',
    phpExample: `$result = match($status) {\n  STATUS_ACTIVE => $running,\n  STATUS_PAUSED => $paused,\n  default => $unknown\n};`,
    phpVersion: '8.0+',
    keywordInExample: 'match',
    fieldHighlights: {
      subject: ['$status'],
      arms: ['STATUS_ACTIVE => $running', 'STATUS_PAUSED => $paused', 'default => $unknown']
    },
    fields: [
      { name: 'subject', type: 'Expr', description: 'Expression to match' },
      { name: 'arms', type: 'Vec<MatchArm>', description: 'Match arms' }
    ]
  },
  {
    id: 'expr-method-call',
    group: 'Class/Object Operations',
    name: 'MethodCall',
    description: 'Object method call',
    phpExample: `$obj->method($arg);\n$obj->compute($x, $y);`,
    fieldHighlights: {
      object: ['$obj'],
      method: ['method', 'compute'],
      args: ['$arg', '$x', '$y']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object' },
      { name: 'method', type: 'Expr', description: 'Method name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-new',
    group: 'Class/Object Operations',
    name: 'New',
    description: 'Create new object instance',
    phpExample: `new DateTime($now);\nnew MyClass($arg);`,
    keywordInExample: 'new',
    fieldHighlights: {
      class: ['DateTime', 'MyClass'],
      args: ['$now', '$arg']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Constructor arguments' }
    ]
  },
  {
    id: 'expr-nowdoc',
    group: 'Variables & Values',
    name: 'Nowdoc',
    description: 'Nowdoc string (no interpolation)',
    phpExample: `$str = <<<'EOT'\nLiteral $text\nEOT;`,
    keywordInExample: '<<<',
    fieldHighlights: {
      label: ['EOT'],
      value: ['Literal $text']
    },
    fields: [
      { name: 'label', type: 'string', description: 'Nowdoc label' },
      { name: 'value', type: 'string', description: 'String content' }
    ]
  },
  {
    id: 'expr-null',
    group: 'Variables & Values',
    name: 'Null',
    description: 'Null literal',
    phpExample: `$value = null;`,
    keywordInExample: 'null',
    fields: []
  },
  {
    id: 'expr-null-coalesce',
    group: 'Operations',
    name: 'NullCoalesce',
    description: 'Null coalescing operator',
    phpExample: `$name = $var ?? $default;\n$value = $a ?? $b ?? $c;`,
    fieldHighlights: {
      left: ['$var', '$a'],
      right: ['$default', '$b ?? $c']
    },
    fields: [
      { name: 'left', type: 'Expr', description: 'First expression' },
      { name: 'right', type: 'Expr', description: 'Default expression' }
    ]
  },
  {
    id: 'expr-nullsafe-method',
    group: 'Class/Object Operations',
    name: 'NullsafeMethodCall',
    description: 'Nullsafe method call (PHP 8.0+)',
    phpExample: `$obj?->method($arg);\n$result = $user?->getProfile()?->getName();`,
    phpVersion: '8.0+',
    fieldHighlights: {
      object: ['$obj', '$user'],
      method: ['method', 'getProfile', 'getName'],
      args: ['$arg']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object' },
      { name: 'method', type: 'Expr', description: 'Method name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-nullsafe-property',
    group: 'Class/Object Operations',
    name: 'NullsafePropertyAccess',
    description: 'Nullsafe property access (PHP 8.0+)',
    phpExample: `$obj?->prop;\n$result = $user?->profile?->name;`,
    phpVersion: '8.0+',
    fieldHighlights: {
      object: ['$obj', '$user'],
      property: ['prop', 'profile', 'name']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object' },
      { name: 'property', type: 'Expr', description: 'Property name' }
    ]
  },
  {
    id: 'expr-omit',
    group: 'Other Expressions',
    name: 'Omit',
    description: 'Omitted array element (skipped slot)',
    phpExample: `[$a, , $c];\nlist($first, , $last) = ["John", "M", "Doe"];`,
    fields: []
  },
  {
    id: 'expr-parenthesized',
    group: 'Operations',
    name: 'Parenthesized',
    description: 'Expression wrapped in parentheses',
    phpExample: `$result = ($a + $b) * $c;\n$value = ($x);`,
    fieldHighlights: {
      expr: ['$a + $b', '$x']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Wrapped expression' }
    ]
  },
  {
    id: 'expr-print',
    group: 'Output/Communication',
    name: 'Print',
    description: 'Print construct',
    phpExample: `print $greeting;\nprint($name);`,
    keywordInExample: 'print',
    fieldHighlights: {
      value: ['$greeting', '$name']
    },
    fields: [
      { name: 'value', type: 'Expr', description: 'Value to print' }
    ]
  },
  {
    id: 'expr-property-access',
    group: 'Class/Object Operations',
    name: 'PropertyAccess',
    description: 'Object property access',
    phpExample: `$obj->name;\n$obj->count;`,
    fieldHighlights: {
      object: ['$obj'],
      property: ['name', 'count']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object' },
      { name: 'property', type: 'Expr', description: 'Property name' }
    ]
  },
  {
    id: 'expr-shell-exec',
    group: 'Other Expressions',
    name: 'ShellExec',
    description: 'Shell execution (backticks)',
    phpExample: `$output = \`ls -la\`;\necho \`date\`;`,
    fieldHighlights: {
      parts: ['ls -la', 'date']
    },
    fields: [
      { name: 'parts', type: 'Vec<StringPart>', description: 'Command parts' }
    ]
  },
  {
    id: 'expr-static-dyn-method',
    group: 'Class/Object Operations',
    name: 'StaticDynMethodCall',
    description: 'Dynamic static method call (Class::$method(args))',
    phpExample: `MyClass::$method($arg);`,
    fieldHighlights: {
      class: ['MyClass'],
      method: ['$method'],
      args: ['$arg']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'method', type: 'Expr', description: 'Dynamic method name (variable)' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-static-method',
    group: 'Class/Object Operations',
    name: 'StaticMethodCall',
    description: 'Static method call',
    phpExample: `MyClass::method($arg);\nMyClass::compute($x);`,
    fieldHighlights: {
      class: ['MyClass'],
      method: ['method', 'compute'],
      args: ['$arg', '$x']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'method', type: 'Expr', description: 'Method name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-static-property',
    group: 'Class/Object Operations',
    name: 'StaticPropertyAccess',
    description: 'Static property access',
    phpExample: `MyClass::$property;\nMyClass::$count;`,
    fieldHighlights: {
      class: ['MyClass'],
      member: ['$property', '$count']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'member', type: 'Expr', description: 'Property name' }
    ]
  },
  {
    id: 'expr-static-prop-dyn',
    group: 'Class/Object Operations',
    name: 'StaticPropertyAccessDynamic',
    description: 'Dynamic static property access (A::$$b)',
    phpExample: `$prop = $name;\nMyClass::$$prop;`,
    fieldHighlights: {
      class: ['MyClass'],
      member: ['$$prop']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'member', type: 'Expr', description: 'Dynamic property expression' }
    ]
  },
  {
    id: 'expr-string',
    group: 'Variables & Values',
    name: 'String',
    description: 'String literal (single-quoted or non-interpolated double-quoted)',
    phpExample: `$str = 'hello world';\n$str2 = "goodbye";`,
    fieldHighlights: {
      value: ['hello world', 'goodbye']
    },
    fields: [
      { name: 'value', type: 'string', description: 'String content' }
    ]
  },
  {
    id: 'expr-ternary',
    group: 'Operations',
    name: 'Ternary',
    description: 'Ternary conditional operator',
    phpExample: `$result = $x != 0 ? $positive : $nonPositive;\n$short = $x ?: $default;`,
    fieldHighlights: {
      condition: ['$x != 0', '$x'],
      then_expr: ['$positive'],
      else_expr: ['$nonPositive', '$default']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Condition' },
      { name: 'then_expr', type: 'Option<Expr>', description: 'Then expression', optional: true },
      { name: 'else_expr', type: 'Expr', description: 'Else expression' }
    ]
  },
  {
    id: 'expr-throw',
    group: 'Other Expressions',
    name: 'ThrowExpr',
    description: 'Throw expression (PHP 8.0+)',
    phpExample: `$x = $value ?? throw new InvalidArgumentException($msg);`,
    phpVersion: '8.0+',
    keywordInExample: 'throw',
    fieldHighlights: {
      exception: ['new InvalidArgumentException($msg)']
    },
    fields: [
      { name: 'exception', type: 'Expr', description: 'Exception to throw' }
    ]
  },
  {
    id: 'expr-unary-postfix',
    group: 'Operations',
    name: 'UnaryPostfix',
    description: 'Postfix unary operation',
    phpExample: `$x++;\n$y--;`,
    fieldHighlights: {
      op: ['++', '--']
    },
    fields: [
      { name: 'operand', type: 'Expr', description: 'Operand' },
      { name: 'op', type: 'UnaryPostfixOp', description: 'Operator (++, --)' }
    ]
  },
  {
    id: 'expr-unary-prefix',
    group: 'Operations',
    name: 'UnaryPrefix',
    description: 'Prefix unary operation',
    phpExample: `$neg = -$x;\n$not = !$flag;\n$inc = ++$counter;`,
    fieldHighlights: {
      op: ['-', '!', '++']
    },
    fields: [
      { name: 'op', type: 'UnaryPrefixOp', description: 'Operator (-, !, ++, --)' },
      { name: 'operand', type: 'Expr', description: 'Operand' }
    ]
  },
  {
    id: 'expr-variable',
    group: 'Variables & Values',
    name: 'Variable',
    description: 'Variable reference',
    phpExample: `$name = $value;\necho $name;`,
    fieldHighlights: {
      name: ['$name', '$value']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Variable name (without $)' }
    ]
  },
  {
    id: 'expr-variable-variable',
    group: 'Variables & Values',
    name: 'VariableVariable',
    description: 'Variable variable (dynamic variable names)',
    phpExample: `$var = $hello;\n$$var = $world;\necho $hello;`,
    fieldHighlights: {
      expr: ['$$var']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Expression to resolve to variable name' }
    ]
  },
  {
    id: 'expr-yield',
    group: 'Operations',
    name: 'Yield',
    description: 'Yield value from generator',
    phpExample: `function gen() {\n  yield 1;\n  yield $key => 2;\n  yield from $items;\n}`,
    keywordInExample: 'yield',
    fieldHighlights: {
      key: ['$key'],
      value: ['1', '2'],
      is_from: ['yield from']
    },
    fields: [
      { name: 'key', type: 'Option<Expr>', description: 'Key for yield', optional: true },
      { name: 'value', type: 'Option<Expr>', description: 'Value to yield', optional: true },
      { name: 'is_from', type: 'bool', description: 'Is yield from' }
    ]
  },
  // ========== DECLARATIONS ==========
  {
    id: 'decl-class-const',
    group: 'Declarations',
    name: 'ClassConstDecl',
    description: 'Class constant',
    phpExample: `class Config {\n  const VERSION: int = 1;\n  protected final const DEFAULT_VAL: int = 0;\n}`,
    keywordInExample: 'const',
    fieldHighlights: {
      name: ['VERSION', 'DEFAULT_VAL'],
      visibility: ['protected'],
      is_final: ['final'],
      type_hint: ['int'],
      value: ['1', '0']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Constant name' },
      { name: 'visibility', type: 'Option<Visibility>', description: 'Visibility', optional: true },
      { name: 'is_final', type: 'bool', description: 'Is final' },
      { name: 'type_hint', type: 'Option<TypeHint>', description: 'Type hint', optional: true },
      { name: 'value', type: 'Expr', description: 'Constant value' }
    ]
  },
  {
    id: 'decl-enum-case',
    group: 'Declarations',
    name: 'EnumCase',
    description: 'Enum case',
    phpExample: `enum Color {\n  case Red;\n  case Green = GREEN_VALUE;\n}`,
    keywordInExample: 'case',
    fieldHighlights: {
      name: ['Red', 'Green'],
      value: ['GREEN_VALUE']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Case name' },
      { name: 'value', type: 'Option<Expr>', description: 'Case value (backed enums)', optional: true }
    ]
  },
  {
    id: 'decl-method',
    group: 'Declarations',
    name: 'MethodDecl',
    description: 'Class method',
    phpExample: `class User {\n  public function &getValue(): string { return $this->value; }\n  abstract protected function validate();\n  final public static function create(int $id): self { return new User(); }\n}`,
    fieldHighlights: {
      name: ['getValue', 'validate', 'create'],
      visibility: ['public', 'protected'],
      is_abstract: ['abstract'],
      is_static: ['static'],
      is_final: ['final'],
      by_ref: ['&'],
      params: ['int $id'],
      return_type: ['string', 'self'],
      body: ['return $this->value;', 'return new User();']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Method name' },
      { name: 'visibility', type: 'Option<Visibility>', description: 'Visibility', optional: true },
      { name: 'is_static', type: 'bool', description: 'Is static' },
      { name: 'is_abstract', type: 'bool', description: 'Is abstract' },
      { name: 'is_final', type: 'bool', description: 'Is final' },
      { name: 'by_ref', type: 'bool', description: 'Returns by reference (&method)' },
      { name: 'params', type: 'Vec<Param>', description: 'Parameters' },
      { name: 'return_type', type: 'Option<TypeHint>', description: 'Return type', optional: true },
      { name: 'body', type: 'Option<Vec<Stmt>>', description: 'Method body', optional: true }
    ]
  },
  {
    id: 'decl-param',
    group: 'Declarations',
    name: 'Param',
    description: 'Function/method parameter',
    phpExample: `class User {\n  function __construct(\n    #[Trim] string $name,\n    protected private(set) string $email {\n      get => $this->_email;\n      set(mixed $v) { $this->_email = $v; }\n    },\n    public final readonly int $age = 0,\n    &$ref = null,\n    ...$rest\n  ) {}\n}`,
    fieldHighlights: {
      name: ['$name', '$email', '$age', '$ref', '$rest'],
      type_hint: ['string', 'int', 'mixed'],
      default: ['0', 'null'],
      by_ref: ['&'],
      variadic: ['...'],
      visibility: ['protected', 'public'],
      set_visibility: ['private(set)'],
      is_readonly: ['readonly'],
      is_final: ['final'],
      attributes: ['#[Trim]'],
      hooks: ['get => $this->_email;', 'set(mixed $v) { $this->_email = $v; }']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Parameter name' },
      { name: 'type_hint', type: 'Option<TypeHint>', description: 'Type hint', optional: true },
      { name: 'default', type: 'Option<Expr>', description: 'Default value', optional: true },
      { name: 'by_ref', type: 'bool', description: 'Passed by reference' },
      { name: 'variadic', type: 'bool', description: 'Variadic (...$args)' },
      { name: 'visibility', type: 'Option<Visibility>', description: 'Constructor promotion visibility', optional: true },
      { name: 'set_visibility', type: 'Option<Visibility>', description: 'Asymmetric set visibility (PHP 8.4+)', optional: true },
      { name: 'is_readonly', type: 'bool', description: 'Readonly promoted property (PHP 8.1+)' },
      { name: 'is_final', type: 'bool', description: 'Final promoted property (PHP 8.4+)' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'PHP attributes (#[...])' },
      { name: 'hooks', type: 'Vec<PropertyHook>', description: 'Property hooks on promoted parameter (PHP 8.4+)' }
    ]
  },
  {
    id: 'decl-property',
    group: 'Declarations',
    name: 'PropertyDecl',
    description: 'Class property',
    phpExample: `class User {\n  public string $name = "John";\n  public static int $counter = 0;\n  protected readonly bool $verified;\n  public private(set) string $email;\n}`,
    fieldHighlights: {
      visibility: ['public', 'protected'],
      is_static: ['static'],
      type_hint: ['string', 'int', 'bool'],
      name: ['$name', '$counter', '$verified', '$email'],
      default: ['"John"', '0'],
      is_readonly: ['readonly'],
      set_visibility: ['private(set)']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Property name' },
      { name: 'visibility', type: 'Option<Visibility>', description: 'public/protected/private', optional: true },
      { name: 'set_visibility', type: 'Option<Visibility>', description: 'Asymmetric set visibility (PHP 8.4+)', optional: true },
      { name: 'is_static', type: 'bool', description: 'Is static' },
      { name: 'is_readonly', type: 'bool', description: 'Is readonly' },
      { name: 'type_hint', type: 'Option<TypeHint>', description: 'Type hint', optional: true },
      { name: 'default', type: 'Option<Expr>', description: 'Default value', optional: true }
    ]
  },
  {
    id: 'decl-property-hook',
    group: 'Declarations',
    name: 'PropertyHook',
    description: 'Property hook - get/set (PHP 8.4+)',
    phpExample: `class User {\n  public string $value {\n    final get &=> $this->_value;\n    final set(string $newValue) { $this->_value = $newValue; }\n  }\n}`,
    phpVersion: '8.4+',
    fieldHighlights: {
      kind: ['get', 'set'],
      is_final: ['final'],
      by_ref: ['&'],
      params: ['string $newValue'],
      body: ['$this->_value', '{ $this->_value = $newValue; }']
    },
    fields: [
      { name: 'kind', type: 'PropertyHookKind', description: 'Get or Set' },
      { name: 'body', type: 'PropertyHookBody', description: 'Hook implementation' },
      { name: 'is_final', type: 'bool', description: 'Is final' },
      { name: 'by_ref', type: 'bool', description: 'Returns by reference (get only)' },
      { name: 'params', type: 'Vec<Param>', description: 'Parameters (set only)' }
    ]
  },
  // ========== TYPES ==========
  {
    id: 'type-builtin',
    group: 'Types',
    name: 'BuiltinType',
    description: 'Built-in type keyword',
    phpExample: `function test(int $x, array $arr, mixed $value): string { }`,
    fieldHighlights: {
      type: ['int', 'array', 'mixed', 'string']
    },
    fields: [
      { name: 'type', type: 'string', description: 'Type keyword (int, string, mixed, etc)' }
    ]
  },
  {
    id: 'type-intersection',
    group: 'Types',
    name: 'Intersection',
    description: 'Intersection type (A&B, PHP 8.1+)',
    phpExample: `function process(Countable&ArrayAccess $data) { }`,
    phpVersion: '8.1+',
    keywordInExample: '&',
    fieldHighlights: {
      types: ['Countable', 'ArrayAccess']
    },
    fields: [
      { name: 'types', type: 'Vec<TypeHint>', description: 'Intersection member types' }
    ]
  },
  {
    id: 'type-named',
    group: 'Types',
    name: 'Named',
    description: 'Named type (class/interface name)',
    phpExample: `function save(User $user): void { }`,
    fieldHighlights: {
      name: ['User']
    },
    fields: [
      { name: 'name', type: 'Name', description: 'Type name (with namespace)' }
    ]
  },
  {
    id: 'type-nullable',
    group: 'Types',
    name: 'Nullable',
    description: 'Nullable type (?T)',
    phpExample: `function getName(): ?string { return null; }`,
    keywordInExample: '?',
    fieldHighlights: {
      type: ['string']
    },
    fields: [
      { name: 'type', type: 'TypeHint', description: 'Wrapped type' }
    ]
  },
  {
    id: 'type-union',
    group: 'Types',
    name: 'Union',
    description: 'Union type (A|B, PHP 8.0+)',
    phpExample: `function getValue(): int|string|null { }`,
    phpVersion: '8.0+',
    keywordInExample: '|',
    fieldHighlights: {
      types: ['int', 'string', 'null']
    },
    fields: [
      { name: 'types', type: 'Vec<TypeHint>', description: 'Union member types' }
    ]
  },
  // ========== HELPERS ==========
  {
    id: 'helper-arg',
    group: 'Components',
    name: 'Arg',
    description: 'Function/method argument',
    phpExample: `foo($a, $b, name: $c, &$ref, ...$spread);`,
    fieldHighlights: {
      name: ['name'],
      value: ['$a', '$b', '$c', '$ref', '$spread'],
      by_ref: ['&'],
      unpack: ['...']
    },
    fields: [
      { name: 'name', type: 'Option<Name>', description: 'Named argument name', optional: true },
      { name: 'value', type: 'Expr', description: 'Argument value' },
      { name: 'unpack', type: 'bool', description: 'Is spread argument (...)' },
      { name: 'by_ref', type: 'bool', description: 'Passed by reference (&)' }
    ]
  },
  {
    id: 'helper-array-element',
    group: 'Components',
    name: 'ArrayElement',
    description: 'A single element in an array literal',
    phpExample: `[$val, $key => $val2, &$ref, ...$spread];`,
    fieldHighlights: {
      key: ['$key'],
      value: ['$val', '$val2', '$ref', '$spread'],
      by_ref: ['&'],
      unpack: ['...']
    },
    fields: [
      { name: 'key', type: 'Option<Expr>', description: 'Array key', optional: true },
      { name: 'value', type: 'Expr', description: 'Array value' },
      { name: 'unpack', type: 'bool', description: 'Spread element (...)' },
      { name: 'by_ref', type: 'bool', description: 'By reference' }
    ]
  },
  {
    id: 'helper-attribute',
    group: 'Components',
    name: 'Attribute',
    description: 'Attribute/annotation',
    phpExample: `#[Route($path)]\n#[Deprecated($msg)]\nfunction handler() {}`,
    keywordInExample: '#',
    fieldHighlights: {
      name: ['Route', 'Deprecated'],
      args: ['$path', '$msg']
    },
    fields: [
      { name: 'name', type: 'Name', description: 'Attribute name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Attribute arguments' }
    ]
  },
  {
    id: 'helper-catch-clause',
    group: 'Components',
    name: 'CatchClause',
    description: 'A single catch in try-catch',
    phpExample: `try {\n  throw new Exception();\n} catch (RuntimeException $e) {\n  throw new LogException('error');\n}`,
    keywordInExample: 'catch',
    fieldHighlights: {
      types: ['RuntimeException'],
      var: ['$e'],
      body: ['throw new LogException(\'error\');']
    },
    fields: [
      { name: 'types', type: 'Vec<Name>', description: 'Caught exception types' },
      { name: 'var', type: 'Option<string>', description: 'Catch variable name', optional: true },
      { name: 'body', type: 'Vec<Stmt>', description: 'Catch block' }
    ]
  },
  {
    id: 'helper-closure-use-var',
    group: 'Components',
    name: 'ClosureUseVar',
    description: 'A variable captured by a closure',
    phpExample: `$counter = 0;\n$fn = function() use (&$counter) {\n  $counter++;\n};`,
    keywordInExample: 'use',
    fieldHighlights: {
      name: ['&$counter'],
      by_ref: ['&']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Variable name' },
      { name: 'by_ref', type: 'bool', description: 'Captured by reference' }
    ]
  },
  {
    id: 'helper-const-item',
    group: 'Components',
    name: 'ConstItem',
    description: 'A single constant in a const statement',
    phpExample: `const MAX_SIZE = 100;\n#[Deprecated]\nconst DB_HOST = DB_DEFAULT_HOST;`,
    keywordInExample: 'const',
    fieldHighlights: {
      name: ['MAX_SIZE', 'DB_HOST'],
      value: ['100', 'DB_DEFAULT_HOST'],
      attributes: ['#[Deprecated]']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Constant name' },
      { name: 'value', type: 'Expr', description: 'Constant value' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'Attributes' }
    ]
  },
  {
    id: 'helper-elseif-branch',
    group: 'Components',
    name: 'ElseIfBranch',
    description: 'A single elseif branch in an if statement',
    phpExample: `if ($x == 1) {\n  echo $x;\n} elseif ($x == 2) {\n  echo 0;\n}`,
    keywordInExample: 'elseif',
    fieldHighlights: {
      condition: ['$x == 2'],
      body: ['echo 0;']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Branch condition' },
      { name: 'body', type: 'Stmt', description: 'Branch body' }
    ]
  },
  {
    id: 'helper-match-arm',
    group: 'Components',
    name: 'MatchArm',
    description: 'A single arm in a match expression',
    phpExample: `match($x) {\n  1, 2 => $small,\n  default => $other\n};`,
    fieldHighlights: {
      conditions: ['1', '2', 'default'],
      body: ['$small', '$other']
    },
    fields: [
      { name: 'conditions', type: 'Option<Vec<Expr>>', description: 'Match conditions (None = default)', optional: true },
      { name: 'body', type: 'Expr', description: 'Arm body expression' }
    ]
  },
  {
    id: 'helper-name',
    group: 'Components',
    name: 'Name',
    description: 'Namespace-qualified name',
    phpExample: `use App\\Models\\User;\nclass Post extends \\App\\Models\\BaseModel implements Countable {}`,
    fieldHighlights: {
      parts: ['App\\Models\\User', '\\App\\Models\\BaseModel', 'Countable']
    },
    fields: [
      { name: 'parts', type: 'Vec<string>', description: 'Name parts (e.g., ["App", "Models", "User"])' },
      { name: 'kind', type: 'NameKind', description: 'Qualified, FullyQualified, Relative, etc' }
    ]
  },
  {
    id: 'helper-program',
    group: 'Components',
    name: 'Program',
    description: 'Root AST node containing all top-level statements',
    phpExample: `$x = 1;\necho $x;`,
    keywordInExample: 'echo',
    fieldHighlights: {
      stmts: ['$x = 1;', 'echo $x;']
    },
    fields: [
      { name: 'stmts', type: 'Vec<Stmt>', description: 'Top-level statements' }
    ]
  },
  {
    id: 'helper-span',
    group: 'Components',
    name: 'Span',
    description: 'Source code location (start and end byte offsets)',
    phpExample: `// Every AST node has a Span indicating where in the source it appears`,
    fieldHighlights: {
      start: ['start'],
      end: ['end']
    },
    fields: [
      { name: 'start', type: 'u32', description: 'Start byte offset' },
      { name: 'end', type: 'u32', description: 'End byte offset' }
    ]
  },
  {
    id: 'helper-static-var',
    group: 'Components',
    name: 'StaticVar',
    description: 'A single static variable declaration',
    phpExample: `function counter() {\n  static $count = 0;\n  return ++$count;\n}`,
    keywordInExample: 'static',
    fieldHighlights: {
      name: ['$count'],
      default: ['0']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Variable name' },
      { name: 'default', type: 'Option<Expr>', description: 'Default value', optional: true }
    ]
  },
  {
    id: 'helper-string-part',
    group: 'Components',
    name: 'StringPart',
    description: 'A part of an interpolated string (literal text or embedded expression)',
    phpExample: `$name = $alice;\necho "Hello $name, you are {$age} old";`,
    keywordInExample: 'echo',
    fieldHighlights: {
      kind: ['Hello ', '$name', '$age', ' old']
    },
    fields: [
      { name: 'kind', type: 'Literal | Expr', description: 'Literal text or embedded expression' }
    ]
  },
  {
    id: 'helper-switch-case',
    group: 'Components',
    name: 'SwitchCase',
    description: 'A single case in a switch statement',
    phpExample: `switch ($x) {\n  case 1:\n    echo $x;\n    break;\n  default:\n    break;\n}`,
    keywordInExample: ['case', 'default'],
    fieldHighlights: {
      value: ['1'],
      body: ['echo $x', 'break']
    },
    fields: [
      { name: 'value', type: 'Option<Expr>', description: 'Case value (None = default)', optional: true },
      { name: 'body', type: 'Vec<Stmt>', description: 'Case body' }
    ]
  },
  {
    id: 'helper-trait-use-decl',
    group: 'Components',
    name: 'TraitUseDecl',
    description: 'use Trait; inside a class body',
    phpExample: `class MyClass {\n  use TraitA, TraitB {\n    TraitA::foo insteadof TraitB;\n  }\n}`,
    keywordInExample: 'use',
    fieldHighlights: {
      traits: ['TraitA', 'TraitB'],
      adaptations: ['TraitA::foo insteadof TraitB']
    },
    fields: [
      { name: 'traits', type: 'Vec<Name>', description: 'Used trait names' },
      { name: 'adaptations', type: 'Vec<TraitAdaptation>', description: 'Conflict resolutions' }
    ]
  },
  {
    id: 'helper-use-item',
    group: 'Components',
    name: 'UseItem',
    description: 'A single imported name in a use statement',
    phpExample: `use App\\Models\\User;\nuse App\\Http\\Controller as Ctrl;`,
    keywordInExample: 'use',
    fieldHighlights: {
      name: ['App\\Models\\User', 'App\\Http\\Controller'],
      alias: ['Ctrl']
    },
    fields: [
      { name: 'name', type: 'Name', description: 'Imported name' },
      { name: 'alias', type: 'Option<string>', description: 'Alias name', optional: true },
      { name: 'kind', type: 'Option<UseKind>', description: 'Override kind for group use', optional: true }
    ]
  },
]
