export interface NodeField {
  name: string
  type: string
  description: string
  optional?: boolean
}

export interface AstNode {
  id: string
  category: 'statement' | 'expression' | 'declaration' | 'type' | 'helper'
  name: string
  description: string
  phpExample: string
  fields?: NodeField[]
  phpVersion?: string
  keywordInExample?: string
  fieldHighlights?: Record<string, string[]>
}

export const astNodes: AstNode[] = [
  // ========== STATEMENTS ==========
  {
    id: 'stmt-block',
    category: 'statement',
    name: 'Block',
    description: 'Block of statements',
    phpExample: `<?php\n{\n  $x = 1;\n  echo $x;\n}`,
    keywordInExample: 'block',
    fieldHighlights: {
      stmts: ['$x = 1', 'echo $x']
    },
    fields: [
      { name: 'stmts', type: 'Vec<Stmt>', description: 'Statements in block' }
    ]
  },
  {
    id: 'stmt-break',
    category: 'statement',
    name: 'Break',
    description: 'Break from loop or switch',
    phpExample: `<?php\nwhile (true) {\n  if ($done) break 2;\n}`,
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
    category: 'statement',
    name: 'Class',
    description: 'Class declaration',
    phpExample: `<?php\nclass Animal extends Base implements Countable {\n  public string $name;\n  public function speak(): void {}\n}`,
    keywordInExample: 'class',
    fieldHighlights: {
      name: ['Animal'],
      extends: ['Base'],
      implements: ['Countable'],
      members: ['public string $name', 'public function speak']
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
    category: 'statement',
    name: 'Const',
    description: 'Global constant declaration',
    phpExample: `<?php\nconst MAX_SIZE = 100;\nconst DB_HOST = DB_DEFAULT_HOST;`,
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
    category: 'statement',
    name: 'Continue',
    description: 'Continue to next iteration of loop',
    phpExample: `<?php\nfor ($i = 0; $i != 10; $i++) {\n  if ($i % 2 == 0) continue;\n  echo $i;\n}`,
    keywordInExample: 'continue',
    fieldHighlights: {
      level: ['continue']
    },
    fields: [
      { name: 'level', type: 'Option<Expr>', description: 'Number of levels to continue', optional: true }
    ]
  },
  {
    id: 'stmt-declare',
    category: 'statement',
    name: 'Declare',
    description: 'Declare directives like strict_types',
    phpExample: `<?php\ndeclare(strict_types=1);\ndeclare(ticks=1) {}`,
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
    category: 'statement',
    name: 'DoWhile',
    description: 'Do-while loop (executes at least once)',
    phpExample: `<?php\ndo {\n  echo $x;\n  $x--;\n} while ($x != 0);`,
    keywordInExample: 'do',
    fieldHighlights: {
      body: ['echo $x', '$x--'],
      condition: ['$x != 0']
    },
    fields: [
      { name: 'body', type: 'Stmt', description: 'Loop body' },
      { name: 'condition', type: 'Expr', description: 'Loop condition' }
    ]
  },
  {
    id: 'stmt-echo',
    category: 'statement',
    name: 'Echo',
    description: 'Output one or more values',
    phpExample: `<?php\necho $greeting, $name, PHP_EOL;`,
    keywordInExample: 'echo',
    fieldHighlights: {
      keyword: ['echo'],
      exprs: ['$greeting', '$name', 'PHP_EOL']
    },
    fields: [
      { name: 'exprs', type: 'Vec<Expr>', description: 'Values to output' }
    ]
  },
  {
    id: 'stmt-enum',
    category: 'statement',
    name: 'Enum',
    description: 'Enumeration declaration (PHP 8.1+)',
    phpExample: `<?php\nenum Status: string {\n  case Active = STATUS_ACTIVE;\n  case Inactive = STATUS_INACTIVE;\n}`,
    phpVersion: '8.1+',
    keywordInExample: 'enum',
    fieldHighlights: {
      name: ['Status'],
      scalar_type: ['string'],
      members: ['case Active', 'case Inactive']
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
    category: 'statement',
    name: 'For',
    description: 'For loop with init/condition/update',
    phpExample: `<?php\nfor ($i = 0; $i != 10; $i++) {\n  echo $i;\n}`,
    keywordInExample: 'for',
    fieldHighlights: {
      init: ['$i = 0'],
      condition: ['$i != 10'],
      update: ['$i++'],
      body: ['echo $i']
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
    category: 'statement',
    name: 'Foreach',
    description: 'Foreach loop over an array or iterable',
    phpExample: `<?php\nforeach ($arr as $key => $value) {\n  echo $key;\n  echo $value;\n}`,
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
    category: 'statement',
    name: 'Function',
    description: 'Function declaration',
    phpExample: `<?php\nfunction greet($name): string {\n  return $name;\n}`,
    keywordInExample: 'function',
    fieldHighlights: {
      name: ['greet'],
      params: ['$name'],
      return_type: ['string'],
      body: ['return $name']
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
    category: 'statement',
    name: 'Global',
    description: 'Declare global variables',
    phpExample: `<?php\n$x = 1;\n\nfunction test() {\n  global $x;\n  $x = 2;\n}`,
    keywordInExample: 'global',
    fieldHighlights: {
      vars: ['$x']
    },
    fields: [
      { name: 'vars', type: 'Vec<Expr>', description: 'Variables to declare global' }
    ]
  },
  {
    id: 'stmt-goto',
    category: 'statement',
    name: 'Goto',
    description: 'Go to label',
    phpExample: `<?php\ngoto end;\necho $skipped;\nend:\necho $done;`,
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
    category: 'statement',
    name: 'HaltCompiler',
    description: '__halt_compiler() — everything after is raw data ignored by PHP',
    phpExample: `<?php\n__halt_compiler();\nThis data is ignored by PHP.`,
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
    category: 'statement',
    name: 'If',
    description: 'Conditional statement with if/elseif/else branches',
    phpExample: `<?php\nif ($x == 1) {\n  echo $positive;\n} elseif ($x == 2) {\n  echo $negative;\n} else {\n  echo $zero;\n}`,
    keywordInExample: 'if',
    fieldHighlights: {
      condition: ['$x == 1'],
      then_branch: ['echo $positive'],
      elseif_branches: ['elseif ($x == 2)'],
      else_branch: ['echo $zero']
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
    category: 'statement',
    name: 'InlineHtml',
    description: 'Inline HTML outside <?php ... ?>',
    phpExample: `<?php echo $php; ?>\nThis is HTML`,
    keywordInExample: 'echo',
    fieldHighlights: {
      html: ['This is HTML']
    },
    fields: [
      { name: 'html', type: 'string', description: 'HTML content' }
    ]
  },
  {
    id: 'stmt-interface',
    category: 'statement',
    name: 'Interface',
    description: 'Interface declaration',
    phpExample: `<?php\ninterface Drawable extends Countable {\n  public function draw(): void;\n}`,
    keywordInExample: 'interface',
    fieldHighlights: {
      name: ['Drawable'],
      extends: ['Countable'],
      members: ['public function draw']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Interface name' },
      { name: 'extends', type: 'Vec<Name>', description: 'Parent interfaces' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Methods' }
    ]
  },
  {
    id: 'stmt-label',
    category: 'statement',
    name: 'Label',
    description: 'Label definition',
    phpExample: `<?php\nloop:\necho $label;\ngoto loop;`,
    keywordInExample: 'label',
    fieldHighlights: {
      name: ['loop']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Label name' }
    ]
  },
  {
    id: 'stmt-namespace',
    category: 'statement',
    name: 'Namespace',
    description: 'Namespace declaration',
    phpExample: `<?php\nnamespace App\\Controllers;\n\nclass Home {}`,
    keywordInExample: 'namespace',
    fieldHighlights: {
      name: ['App\\\\Controllers'],
      body: ['class Home']
    },
    fields: [
      { name: 'name', type: 'Option<Name>', description: 'Namespace name', optional: true },
      { name: 'body', type: 'NamespaceBody', description: 'Namespace contents' }
    ]
  },
  {
    id: 'stmt-nop',
    category: 'statement',
    name: 'Nop',
    description: 'Empty statement (;)',
    phpExample: `<?php\n;`,
    fields: []
  },
  {
    id: 'stmt-return',
    category: 'statement',
    name: 'Return',
    description: 'Return from a function or method',
    phpExample: `<?php\nfunction add($a, $b) {\n  return $a + $b;\n}`,
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
    category: 'statement',
    name: 'StaticVar',
    description: 'Static variable declaration',
    phpExample: `<?php\nfunction counter() {\n  static $count = 0;\n  return ++$count;\n}`,
    keywordInExample: 'static',
    fieldHighlights: {
      vars: ['$count = 0']
    },
    fields: [
      { name: 'vars', type: 'Vec<StaticVar>', description: 'Static variables' }
    ]
  },
  {
    id: 'stmt-switch',
    category: 'statement',
    name: 'Switch',
    description: 'Switch statement with cases and default',
    phpExample: `<?php\nswitch ($x) {\n  case 1:\n    echo $x;\n    break;\n  default:\n    echo $default;\n}`,
    keywordInExample: 'switch',
    fieldHighlights: {
      expr: ['$x'],
      cases: ['case 1', 'default']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Value to switch on' },
      { name: 'cases', type: 'Vec<SwitchCase>', description: 'Switch cases' }
    ]
  },
  {
    id: 'stmt-throw',
    category: 'statement',
    name: 'Throw',
    description: 'Throw an exception',
    phpExample: `<?php\nthrow new RuntimeException($message);`,
    keywordInExample: 'throw',
    fieldHighlights: {
      exception: ['new RuntimeException($message)']
    },
    fields: [
      { name: 'exception', type: 'Expr', description: 'Exception to throw' }
    ]
  },
  {
    id: 'stmt-trait',
    category: 'statement',
    name: 'Trait',
    description: 'Trait declaration',
    phpExample: `<?php\ntrait Logger {\n  public function log($msg) { echo $msg; }\n}`,
    keywordInExample: 'trait',
    fieldHighlights: {
      name: ['Logger'],
      members: ['public function log']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Trait name' },
      { name: 'members', type: 'Vec<ClassMember>', description: 'Methods' }
    ]
  },
  {
    id: 'stmt-try-catch',
    category: 'statement',
    name: 'TryCatch',
    description: 'Try-catch-finally block',
    phpExample: `<?php\ntry {\n  $x = 1 / 0;\n} catch (DivisionByZeroError $e) {\n  echo $e->getMessage();\n} finally {\n  echo $done;\n}`,
    keywordInExample: 'try',
    fieldHighlights: {
      body: ['$x = 1 / 0'],
      catches: ['catch (DivisionByZeroError $e)'],
      finally: ['echo $done']
    },
    fields: [
      { name: 'body', type: 'Vec<Stmt>', description: 'Try block' },
      { name: 'catches', type: 'Vec<CatchClause>', description: 'Catch clauses' },
      { name: 'finally', type: 'Option<Vec<Stmt>>', description: 'Finally block', optional: true }
    ]
  },
  {
    id: 'stmt-unset',
    category: 'statement',
    name: 'Unset',
    description: 'Unset variables',
    phpExample: `<?php\nunset($a, $b, $arr[$key]);`,
    keywordInExample: 'unset',
    fieldHighlights: {
      vars: ['$a', '$b', '$arr[$key]']
    },
    fields: [
      { name: 'vars', type: 'Vec<Expr>', description: 'Variables to unset' }
    ]
  },
  {
    id: 'stmt-use',
    category: 'statement',
    name: 'Use',
    description: 'Use (import) statement',
    phpExample: `<?php\nuse App\\Models\\User;\nuse function Helper\\debug;`,
    keywordInExample: 'use',
    fieldHighlights: {
      kind: ['use function'],
      uses: ['App\\\\Models\\\\User', 'Helper\\\\debug']
    },
    fields: [
      { name: 'kind', type: 'UseKind', description: 'Type of use (Normal, Function, Const)' },
      { name: 'uses', type: 'Vec<UseItem>', description: 'Imported items' }
    ]
  },
  {
    id: 'stmt-while',
    category: 'statement',
    name: 'While',
    description: 'While loop',
    phpExample: `<?php\nwhile ($x != 0) {\n  echo $x;\n  $x--;\n}`,
    keywordInExample: 'while',
    fieldHighlights: {
      condition: ['$x != 0'],
      body: ['echo $x', '$x--']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Loop condition' },
      { name: 'body', type: 'Stmt', description: 'Loop body' }
    ]
  },
  // ========== EXPRESSIONS ==========
  {
    id: 'expr-anonymous-class',
    category: 'expression',
    name: 'AnonymousClass',
    description: 'Anonymous class instance (inline class definition)',
    phpExample: `<?php\n$obj = new class extends Base implements Countable {\n  public function method() {}\n};`,
    keywordInExample: 'class',
    fieldHighlights: {
      class: ['extends Base implements Countable', 'public function method']
    },
    fields: [
      { name: 'class', type: 'ClassDecl', description: 'Anonymous class declaration' }
    ]
  },
  {
    id: 'expr-array',
    category: 'expression',
    name: 'Array',
    description: 'Array literal',
    phpExample: `<?php\n[1, 2, 3];\n[$key => $val, $key2 => $val2];\n[...$items];`,
    keywordInExample: 'array',
    fieldHighlights: {
      elements: ['1', '2', '3', '$key => $val', '$key2 => $val2', '...$items']
    },
    fields: [
      { name: 'elements', type: 'Vec<ArrayElement>', description: 'Array elements' }
    ]
  },
  {
    id: 'expr-array-access',
    category: 'expression',
    name: 'ArrayAccess',
    description: 'Array element access',
    phpExample: `<?php\n$arr[0];\n$arr[$key];\n$arr[];`,
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
    category: 'expression',
    name: 'ArrowFunction',
    description: 'Arrow function (short closure, PHP 7.4+)',
    phpExample: `<?php\n$square = fn($x) => $x * $x;\n$double = fn($n) => $n * 2;`,
    phpVersion: '7.4+',
    keywordInExample: 'arrow',
    fieldHighlights: {
      params: ['$x', '$n'],
      body: ['$x * $x', '$n * 2']
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
    category: 'expression',
    name: 'Assign',
    description: 'Assignment and compound assignments',
    phpExample: `<?php\n$x = 10;\n$x += 5;\n$result ??= $default;`,
    fieldHighlights: {
      target: ['$x', '$result'],
      op: ['+=', '??='],
      value: ['10', '5', '$default']
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
    category: 'expression',
    name: 'Binary',
    description: 'Binary operation',
    phpExample: `<?php\n$sum = $a + $b;\n$cmp = $x <=> $y;\n$obj instanceof MyClass;`,
    keywordInExample: 'instanceof',
    fieldHighlights: {
      left: ['$a', '$x', '$obj'],
      op: ['+', 'instanceof'],
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
    category: 'expression',
    name: 'Bool',
    description: 'Boolean literal',
    phpExample: `<?php\n$yes = true;\n$no = false;`,
    keywordInExample: 'true',
    fieldHighlights: {
      value: ['true', 'false']
    },
    fields: [
      { name: 'value', type: 'bool', description: 'Boolean value' }
    ]
  },
  {
    id: 'expr-callable-create',
    category: 'expression',
    name: 'CallableCreate',
    description: 'Callable creation expression (first-class callables)',
    phpExample: `<?php\n$func = strlen(...);\n$method = $obj->method(...);\n$static = MyClass::staticMethod(...);`,
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
    category: 'expression',
    name: 'Cast',
    description: 'Type cast',
    phpExample: `<?php\n(int)$x;\n(string)$val;\n(array)$obj;`,
    keywordInExample: 'cast',
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
    category: 'expression',
    name: 'ClassConstAccess',
    description: 'Class constant access',
    phpExample: `<?php\nMyClass::VERSION;\nMyClass::MY_CONST;`,
    keywordInExample: 'const',
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
    category: 'expression',
    name: 'ClassConstAccessDynamic',
    description: 'Dynamic class constant access (Foo::{expr})',
    phpExample: `<?php\n$const = $version;\nFoo::{$const};`,
    phpVersion: '8.3+',
    keywordInExample: 'const',
    fieldHighlights: {
      class: ['Foo'],
      member: ['$const']
    },
    fields: [
      { name: 'class', type: 'Expr', description: 'Class name' },
      { name: 'member', type: 'Expr', description: 'Dynamic member expression' }
    ]
  },
  {
    id: 'expr-clone',
    category: 'expression',
    name: 'Clone',
    description: 'Clone an object',
    phpExample: `<?php\n$copy = clone $original;`,
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
    category: 'expression',
    name: 'CloneWith',
    description: 'Clone with property overrides (PHP 8.5+)',
    phpExample: `<?php\n$obj2 = clone($obj, prop: $value);`,
    phpVersion: '8.5+',
    keywordInExample: 'clone',
    fieldHighlights: {
      object: ['$obj'],
      properties: ['prop: $value']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object to clone' },
      { name: 'properties', type: 'Expr', description: 'Property overrides' }
    ]
  },
  {
    id: 'expr-closure',
    category: 'expression',
    name: 'Closure',
    description: 'Anonymous function (closure)',
    phpExample: `<?php\n$add = function($a, $b) use ($multiplier) {\n  return ($a + $b) * $multiplier;\n};`,
    keywordInExample: 'function',
    fieldHighlights: {
      params: ['$a', '$b'],
      use_vars: ['$multiplier'],
      body: ['return ($a + $b) * $multiplier']
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
    category: 'expression',
    name: 'Empty',
    description: 'Check if variable is empty',
    phpExample: `<?php\nempty($var);\nif (empty($str)) {}`,
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
    category: 'expression',
    name: 'ErrorSuppress',
    description: 'Error suppression operator (@)',
    phpExample: `<?php\n@file_get_contents($path);\n@$arr[$key];`,
    keywordInExample: 'suppress',
    fieldHighlights: {
      operand: ['file_get_contents($path)', '$arr[$key]']
    },
    fields: [
      { name: 'operand', type: 'Expr', description: 'Expression to suppress' }
    ]
  },
  {
    id: 'expr-eval',
    category: 'expression',
    name: 'Eval',
    description: 'Evaluate PHP code',
    phpExample: `<?php\neval($code);`,
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
    category: 'expression',
    name: 'Exit',
    description: 'Exit/die construct',
    phpExample: `<?php\nexit($message);\ndie(1);`,
    keywordInExample: 'exit',
    fieldHighlights: {
      value: ['$message', '1']
    },
    fields: [
      { name: 'value', type: 'Option<Expr>', description: 'Exit code or message', optional: true }
    ]
  },
  {
    id: 'expr-float',
    category: 'expression',
    name: 'Float',
    description: 'Float literal',
    phpExample: `<?php\n$pi = 3.14;\n$exp = 1.5e3;`,
    keywordInExample: 'float',
    fieldHighlights: {
      value: ['3.14', '1.5e3']
    },
    fields: [
      { name: 'value', type: 'f64', description: 'Float value' }
    ]
  },
  {
    id: 'expr-function-call',
    category: 'expression',
    name: 'FunctionCall',
    description: 'Function call',
    phpExample: `<?php\nstrlen($str);\narray_map(fn($x) => $x * 2, $arr);`,
    keywordInExample: 'function',
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
    category: 'expression',
    name: 'Heredoc',
    description: 'Heredoc string with interpolation',
    phpExample: `<?php\n$name = $alice;\n$str = <<<EOT\nHello $name\nEOT;`,
    keywordInExample: 'EOT',
    fieldHighlights: {
      label: ['EOT'],
      parts: ['$name']
    },
    fields: [
      { name: 'label', type: 'string', description: 'Heredoc label' },
      { name: 'parts', type: 'Vec<StringPart>', description: 'String parts' }
    ]
  },
  {
    id: 'expr-identifier',
    category: 'expression',
    name: 'Identifier',
    description: 'Bare name used as an expression (function name in a call, class name, etc.)',
    phpExample: `<?php\nstrlen($str);\nMyClass::method();`,
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
    category: 'expression',
    name: 'Include',
    description: 'Include/require files',
    phpExample: `<?php\ninclude $header;\nrequire_once $config;`,
    keywordInExample: 'include',
    fieldHighlights: {
      kind: ['include', 'require_once'],
      file: ['$header', '$config']
    },
    fields: [
      { name: 'kind', type: 'IncludeKind', description: 'Include/require/once variant' },
      { name: 'file', type: 'Expr', description: 'File path' }
    ]
  },
  {
    id: 'expr-int',
    category: 'expression',
    name: 'Int',
    description: 'Integer literal',
    phpExample: `<?php\n$x = 42;\n$hex = 0xFF;\n$bin = 0b1010;`,
    keywordInExample: 'int',
    fieldHighlights: {
      value: ['42', '0xFF', '0b1010']
    },
    fields: [
      { name: 'value', type: 'i64', description: 'Integer value' }
    ]
  },
  {
    id: 'expr-interpolated-string',
    category: 'expression',
    name: 'InterpolatedString',
    description: 'Double-quoted string with variable interpolation',
    phpExample: `<?php\n$name = $alice;\necho "Hello $name";\necho "Result: {$obj->prop}";`,
    keywordInExample: 'echo',
    fieldHighlights: {
      parts: ['$name', '$obj->prop']
    },
    fields: [
      { name: 'parts', type: 'Vec<StringPart>', description: 'String parts (literals and expressions)' }
    ]
  },
  {
    id: 'expr-isset',
    category: 'expression',
    name: 'Isset',
    description: 'Check if variables are set',
    phpExample: `<?php\nisset($var);\nisset($arr[$key], $obj->prop);`,
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
    category: 'expression',
    name: 'MagicConst',
    description: 'Magic constant (__LINE__, __FILE__, etc)',
    phpExample: `<?php\necho __LINE__;\necho __FILE__;\necho __DIR__;`,
    keywordInExample: '__LINE__',
    fieldHighlights: {
      kind: ['__LINE__', '__FILE__', '__DIR__']
    },
    fields: [
      { name: 'kind', type: 'MagicConstKind', description: 'Magic constant type' }
    ]
  },
  {
    id: 'expr-match',
    category: 'expression',
    name: 'Match',
    description: 'Match expression (PHP 8.0+)',
    phpExample: `<?php\n$result = match($status) {\n  STATUS_ACTIVE => $running,\n  STATUS_PAUSED => $paused,\n  default => $unknown\n};`,
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
    category: 'expression',
    name: 'MethodCall',
    description: 'Object method call',
    phpExample: `<?php\n$obj->method($arg);\n$obj->compute($x);`,
    keywordInExample: 'method',
    fieldHighlights: {
      object: ['$obj'],
      method: ['method', 'compute'],
      args: ['$arg', '$x']
    },
    fields: [
      { name: 'object', type: 'Expr', description: 'Object' },
      { name: 'method', type: 'Expr', description: 'Method name' },
      { name: 'args', type: 'Vec<Arg>', description: 'Arguments' }
    ]
  },
  {
    id: 'expr-new',
    category: 'expression',
    name: 'New',
    description: 'Create new object instance',
    phpExample: `<?php\nnew DateTime($now);\nnew MyClass($arg);`,
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
    category: 'expression',
    name: 'Nowdoc',
    description: 'Nowdoc string (no interpolation)',
    phpExample: `<?php\n$str = <<<'EOT'\nLiteral $text\nEOT;`,
    keywordInExample: 'EOT',
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
    category: 'expression',
    name: 'Null',
    description: 'Null literal',
    phpExample: `<?php\n$value = null;`,
    keywordInExample: 'null',
    fields: []
  },
  {
    id: 'expr-null-coalesce',
    category: 'expression',
    name: 'NullCoalesce',
    description: 'Null coalescing operator',
    phpExample: `<?php\n$name = $var ?? $default;\n$value = $a ?? $b ?? $c;`,
    keywordInExample: 'coalesce',
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
    category: 'expression',
    name: 'NullsafeMethodCall',
    description: 'Nullsafe method call (PHP 8.0+)',
    phpExample: `<?php\n$obj?->method($arg);\n$result = $user?->getProfile()?->getName();`,
    phpVersion: '8.0+',
    keywordInExample: 'method',
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
    category: 'expression',
    name: 'NullsafePropertyAccess',
    description: 'Nullsafe property access (PHP 8.0+)',
    phpExample: `<?php\n$obj?->prop;\n$result = $user?->profile?->name;`,
    phpVersion: '8.0+',
    keywordInExample: 'property',
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
    category: 'expression',
    name: 'Omit',
    description: 'Omitted array element (skipped slot)',
    phpExample: `<?php\n[$a, , $c];\nlist($x, , $z) = [1, 2, 3];`,
    keywordInExample: 'list',
    fields: []
  },
  {
    id: 'expr-parenthesized',
    category: 'expression',
    name: 'Parenthesized',
    description: 'Expression wrapped in parentheses',
    phpExample: `<?php\n$result = ($a + $b) * $c;\n$value = ($x);`,
    fieldHighlights: {
      expr: ['$a + $b', '$x']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Wrapped expression' }
    ]
  },
  {
    id: 'expr-print',
    category: 'expression',
    name: 'Print',
    description: 'Print construct',
    phpExample: `<?php\nprint $greeting;\nprint($name);`,
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
    category: 'expression',
    name: 'PropertyAccess',
    description: 'Object property access',
    phpExample: `<?php\n$obj->name;\n$obj->count;`,
    keywordInExample: 'property',
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
    category: 'expression',
    name: 'ShellExec',
    description: 'Shell execution (backticks)',
    phpExample: `<?php\n$output = \`ls -la\`;\necho \`date\`;`,
    keywordInExample: 'echo',
    fieldHighlights: {
      parts: ['ls -la', 'date']
    },
    fields: [
      { name: 'parts', type: 'Vec<StringPart>', description: 'Command parts' }
    ]
  },
  {
    id: 'expr-static-dyn-method',
    category: 'expression',
    name: 'StaticDynMethodCall',
    description: 'Dynamic static method call (Class::$method(args))',
    phpExample: `<?php\nMyClass::$method($arg);`,
    keywordInExample: 'static',
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
    category: 'expression',
    name: 'StaticMethodCall',
    description: 'Static method call',
    phpExample: `<?php\nMyClass::method($arg);\nMyClass::compute($x);`,
    keywordInExample: 'static',
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
    category: 'expression',
    name: 'StaticPropertyAccess',
    description: 'Static property access',
    phpExample: `<?php\nMyClass::$property;\nMyClass::$count;`,
    keywordInExample: 'static',
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
    category: 'expression',
    name: 'StaticPropertyAccessDynamic',
    description: 'Dynamic static property access (A::$$b)',
    phpExample: `<?php\n$prop = $name;\nMyClass::$$prop;`,
    keywordInExample: 'static',
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
    category: 'expression',
    name: 'String',
    description: 'String literal (single-quoted or non-interpolated double-quoted)',
    phpExample: `<?php\n$str = 'hello world';\n$str2 = "goodbye";`,
    fieldHighlights: {
      value: ['hello world', 'goodbye']
    },
    fields: [
      { name: 'value', type: 'string', description: 'String content' }
    ]
  },
  {
    id: 'expr-ternary',
    category: 'expression',
    name: 'Ternary',
    description: 'Ternary conditional operator',
    phpExample: `<?php\n$result = $x != 0 ? $positive : $nonPositive;\n$short = $x ?: $default;`,
    keywordInExample: 'ternary',
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
    category: 'expression',
    name: 'ThrowExpr',
    description: 'Throw expression (PHP 8.0+)',
    phpExample: `<?php\n$x = $value ?? throw new InvalidArgumentException($msg);`,
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
    category: 'expression',
    name: 'UnaryPostfix',
    description: 'Postfix unary operation',
    phpExample: `<?php\n$x++;\n$y--;`,
    fieldHighlights: {
      operand: ['$x', '$y'],
      op: ['$x++', '$y--']
    },
    fields: [
      { name: 'operand', type: 'Expr', description: 'Operand' },
      { name: 'op', type: 'UnaryPostfixOp', description: 'Operator (++, --)' }
    ]
  },
  {
    id: 'expr-unary-prefix',
    category: 'expression',
    name: 'UnaryPrefix',
    description: 'Prefix unary operation',
    phpExample: `<?php\n$neg = -$x;\n$not = !$flag;\n$inc = ++$counter;`,
    fieldHighlights: {
      op: ['-$x', '!$flag', '++$counter'],
      operand: ['$x', '$flag', '$counter']
    },
    fields: [
      { name: 'op', type: 'UnaryPrefixOp', description: 'Operator (-, !, ++, --)' },
      { name: 'operand', type: 'Expr', description: 'Operand' }
    ]
  },
  {
    id: 'expr-variable',
    category: 'expression',
    name: 'Variable',
    description: 'Variable reference',
    phpExample: `<?php\n$name = $value;\necho $name;`,
    keywordInExample: 'variable',
    fieldHighlights: {
      name: ['$name', '$value']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Variable name (without $)' }
    ]
  },
  {
    id: 'expr-variable-variable',
    category: 'expression',
    name: 'VariableVariable',
    description: 'Variable variable (dynamic variable names)',
    phpExample: `<?php\n$var = $hello;\n$$var = $world;\necho $hello;`,
    keywordInExample: 'variable',
    fieldHighlights: {
      expr: ['$var', '$$var']
    },
    fields: [
      { name: 'expr', type: 'Expr', description: 'Expression to resolve to variable name' }
    ]
  },
  {
    id: 'expr-yield',
    category: 'expression',
    name: 'Yield',
    description: 'Yield value from generator',
    phpExample: `<?php\nfunction gen() {\n  yield 1;\n  yield $key => 2;\n  yield from $items;\n}`,
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
    category: 'declaration',
    name: 'ClassConstDecl',
    description: 'Class constant',
    phpExample: `<?php\nconst VERSION = 1;\nfinal protected const DEFAULT_VAL = 0;`,
    keywordInExample: 'const',
    fieldHighlights: {
      name: ['VERSION', 'DEFAULT_VAL'],
      visibility: ['protected'],
      is_final: ['final'],
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
    category: 'declaration',
    name: 'EnumCase',
    description: 'Enum case',
    phpExample: `<?php\nenum Color {\n  case Red;\n  case Green = GREEN_VALUE;\n}`,
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
    category: 'declaration',
    name: 'MethodDecl',
    description: 'Class method',
    phpExample: `<?php\npublic function getValue(): string { return $value; }\nabstract protected function validate();`,
    keywordInExample: 'method',
    fieldHighlights: {
      name: ['getValue', 'validate'],
      visibility: ['public', 'protected'],
      is_abstract: ['abstract'],
      params: [],
      return_type: ['string'],
      body: ['return $value']
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
    category: 'declaration',
    name: 'Param',
    description: 'Function/method parameter',
    phpExample: `<?php\nfunction foo(string $name, int $age = 0, &$ref = null, ...$rest) {}`,
    keywordInExample: 'function',
    fieldHighlights: {
      name: ['$name', '$age', '$ref', '$rest'],
      type_hint: ['string', 'int'],
      default: ['0', 'null'],
      by_ref: ['&$ref'],
      variadic: ['...$rest']
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
    category: 'declaration',
    name: 'PropertyDecl',
    description: 'Class property',
    phpExample: `<?php\npublic string $name = $default;\nprivate readonly int $id;`,
    keywordInExample: 'property',
    fieldHighlights: {
      name: ['$name', '$id'],
      visibility: ['public', 'private'],
      is_readonly: ['readonly'],
      type_hint: ['string', 'int'],
      default: ['$default']
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
    category: 'declaration',
    name: 'PropertyHook',
    description: 'Property hook - get/set (PHP 8.4+)',
    phpExample: `<?php\npublic string $value {\n  get => strtoupper($this->_value);\n  set(string $v) { $this->_value = $v; }\n}`,
    phpVersion: '8.4+',
    keywordInExample: 'hook',
    fieldHighlights: {
      kind: ['get', 'set'],
      body: ['strtoupper($this->_value)', '$this->_value = $v'],
      params: ['$v']
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
    category: 'type',
    name: 'BuiltinType',
    description: 'Built-in type keyword',
    phpExample: `<?php\nfunction test(int $x, array $arr, mixed $value): string { }`,
    keywordInExample: 'builtin',
    fieldHighlights: {
      type: ['int', 'array', 'mixed', 'string']
    },
    fields: [
      { name: 'type', type: 'string', description: 'Type keyword (int, string, mixed, etc)' }
    ]
  },
  {
    id: 'type-intersection',
    category: 'type',
    name: 'Intersection',
    description: 'Intersection type (A&B, PHP 8.1+)',
    phpExample: `<?php\nfunction process(Countable&ArrayAccess $data) { }`,
    phpVersion: '8.1+',
    keywordInExample: 'intersection',
    fieldHighlights: {
      types: ['Countable&ArrayAccess']
    },
    fields: [
      { name: 'types', type: 'Vec<TypeHint>', description: 'Intersection member types' }
    ]
  },
  {
    id: 'type-named',
    category: 'type',
    name: 'Named',
    description: 'Named type (class/interface name)',
    phpExample: `<?php\nfunction save(User $user): void { }`,
    keywordInExample: 'named',
    fieldHighlights: {
      name: ['User']
    },
    fields: [
      { name: 'name', type: 'Name', description: 'Type name (with namespace)' }
    ]
  },
  {
    id: 'type-nullable',
    category: 'type',
    name: 'Nullable',
    description: 'Nullable type (?T)',
    phpExample: `<?php\nfunction getName(): ?string { return null; }`,
    keywordInExample: 'nullable',
    fieldHighlights: {
      type: ['?string']
    },
    fields: [
      { name: 'type', type: 'TypeHint', description: 'Wrapped type' }
    ]
  },
  {
    id: 'type-union',
    category: 'type',
    name: 'Union',
    description: 'Union type (A|B, PHP 8.0+)',
    phpExample: `<?php\nfunction getValue(): int|string|null { }`,
    phpVersion: '8.0+',
    keywordInExample: 'union',
    fieldHighlights: {
      types: ['int|string|null']
    },
    fields: [
      { name: 'types', type: 'Vec<TypeHint>', description: 'Union member types' }
    ]
  },
  // ========== HELPERS ==========
  {
    id: 'helper-arg',
    category: 'helper',
    name: 'Arg',
    description: 'Function/method argument',
    phpExample: `<?php\nfoo($a, $b, name: $c, ...$spread);`,
    fieldHighlights: {
      name: ['name'],
      value: ['$a', '$b', '$c', '$spread'],
      unpack: ['...$spread']
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
    category: 'helper',
    name: 'ArrayElement',
    description: 'A single element in an array literal',
    phpExample: `<?php\n[$val, $key => $val2, ...$spread];`,
    fieldHighlights: {
      key: ['$key'],
      value: ['$val', '$val2', '$spread'],
      unpack: ['...$spread']
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
    category: 'helper',
    name: 'Attribute',
    description: 'Attribute/annotation',
    phpExample: `<?php\n#[Route($path)]\n#[Deprecated($msg)]\nfunction handler() {}`,
    keywordInExample: 'attribute',
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
    category: 'helper',
    name: 'CatchClause',
    description: 'A single catch in try-catch',
    phpExample: `<?php\ntry {\n  throw new RuntimeException();\n} catch (RuntimeException $e) {\n  echo $e;\n}`,
    keywordInExample: 'catch',
    fieldHighlights: {
      types: ['RuntimeException'],
      var: ['$e'],
      body: ['echo $e']
    },
    fields: [
      { name: 'types', type: 'Vec<Name>', description: 'Caught exception types' },
      { name: 'var', type: 'Option<string>', description: 'Catch variable name', optional: true },
      { name: 'body', type: 'Vec<Stmt>', description: 'Catch block' }
    ]
  },
  {
    id: 'helper-closure-use-var',
    category: 'helper',
    name: 'ClosureUseVar',
    description: 'A variable captured by a closure',
    phpExample: `<?php\n$multiplier = 3;\n$fn = function($x) use ($multiplier) {\n  return $x * $multiplier;\n};`,
    keywordInExample: 'use',
    fieldHighlights: {
      name: ['$multiplier']
    },
    fields: [
      { name: 'name', type: 'string', description: 'Variable name' },
      { name: 'by_ref', type: 'bool', description: 'Captured by reference' }
    ]
  },
  {
    id: 'helper-const-item',
    category: 'helper',
    name: 'ConstItem',
    description: 'A single constant in a const statement',
    phpExample: `<?php\nconst MAX_SIZE = 100;\nconst DB_HOST = DB_DEFAULT_HOST;`,
    keywordInExample: 'const',
    fieldHighlights: {
      name: ['MAX_SIZE', 'DB_HOST'],
      value: ['100', 'DB_DEFAULT_HOST']
    },
    fields: [
      { name: 'name', type: 'Ident', description: 'Constant name' },
      { name: 'value', type: 'Expr', description: 'Constant value' },
      { name: 'attributes', type: 'Vec<Attribute>', description: 'Attributes' }
    ]
  },
  {
    id: 'helper-elseif-branch',
    category: 'helper',
    name: 'ElseIfBranch',
    description: 'A single elseif branch in an if statement',
    phpExample: `<?php\nif ($x == 1) {\n  echo $x;\n} elseif ($x == 2) {\n  echo 0;\n}`,
    keywordInExample: 'elseif',
    fieldHighlights: {
      condition: ['$x == 2'],
      body: ['echo 0']
    },
    fields: [
      { name: 'condition', type: 'Expr', description: 'Branch condition' },
      { name: 'body', type: 'Stmt', description: 'Branch body' }
    ]
  },
  {
    id: 'helper-match-arm',
    category: 'helper',
    name: 'MatchArm',
    description: 'A single arm in a match expression',
    phpExample: `<?php\nmatch($x) {\n  1, 2 => $small,\n  default => $other\n};`,
    keywordInExample: 'default',
    fieldHighlights: {
      conditions: ['1', '2'],
      body: ['$small', '$other']
    },
    fields: [
      { name: 'conditions', type: 'Option<Vec<Expr>>', description: 'Match conditions (None = default)', optional: true },
      { name: 'body', type: 'Expr', description: 'Arm body expression' }
    ]
  },
  {
    id: 'helper-name',
    category: 'helper',
    name: 'Name',
    description: 'Namespace-qualified name',
    phpExample: `<?php\nuse App\\Models\\User;\nclass Post extends BaseModel {}`,
    keywordInExample: 'use',
    fieldHighlights: {
      parts: ['App\\\\Models\\\\User', 'BaseModel'],
      kind: ['Unqualified', 'Qualified', 'FullyQualified']
    },
    fields: [
      { name: 'parts', type: 'Vec<string>', description: 'Name parts (e.g., ["App", "Models", "User"])' },
      { name: 'kind', type: 'NameKind', description: 'Qualified, FullyQualified, Relative, etc' }
    ]
  },
  {
    id: 'helper-program',
    category: 'helper',
    name: 'Program',
    description: 'Root AST node containing all top-level statements',
    phpExample: `<?php\n$x = 1;\necho $x;`,
    keywordInExample: 'echo',
    fieldHighlights: {
      stmts: ['$x = 1', 'echo $x']
    },
    fields: [
      { name: 'stmts', type: 'Vec<Stmt>', description: 'Top-level statements' }
    ]
  },
  {
    id: 'helper-span',
    category: 'helper',
    name: 'Span',
    description: 'Source code location (start and end byte offsets)',
    phpExample: `<?php\n// Every AST node has a Span indicating where in the source it appears`,
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
    category: 'helper',
    name: 'StaticVar',
    description: 'A single static variable declaration',
    phpExample: `<?php\nfunction counter() {\n  static $count = 0;\n  return ++$count;\n}`,
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
    category: 'helper',
    name: 'StringPart',
    description: 'A part of an interpolated string (literal text or embedded expression)',
    phpExample: `<?php\n$name = $alice;\necho "Hello $name, you are {$age} old";`,
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
    category: 'helper',
    name: 'SwitchCase',
    description: 'A single case in a switch statement',
    phpExample: `<?php\nswitch ($x) {\n  case 1:\n    echo $x;\n    break;\n  default:\n    break;\n}`,
    keywordInExample: 'case',
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
    category: 'helper',
    name: 'TraitUseDecl',
    description: 'use Trait; inside a class body',
    phpExample: `<?php\nclass MyClass {\n  use TraitA, TraitB {\n    TraitA::foo insteadof TraitB;\n  }\n}`,
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
    category: 'helper',
    name: 'UseItem',
    description: 'A single imported name in a use statement',
    phpExample: `<?php\nuse App\\Models\\User;\nuse App\\Http\\Controller as Ctrl;`,
    keywordInExample: 'use',
    fieldHighlights: {
      name: ['App\\\\Models\\\\User', 'App\\\\Http\\\\Controller'],
      alias: ['Ctrl']
    },
    fields: [
      { name: 'name', type: 'Name', description: 'Imported name' },
      { name: 'alias', type: 'Option<string>', description: 'Alias name', optional: true },
      { name: 'kind', type: 'Option<UseKind>', description: 'Override kind for group use', optional: true }
    ]
  },
]
