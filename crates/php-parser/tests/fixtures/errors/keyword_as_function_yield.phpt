===source===
<?php function yield() {}
===errors===
cannot use 'yield' as function name; it is reserved
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "yield",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "yield", expecting "(" in Standard input code on line 1
