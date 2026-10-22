===source===
<?php function yield() {}
===errors===
cannot use 'yield' as function name; it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'yield' (T_YIELD), expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "yield", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "yield",
            "span": {
              "start": 15,
              "end": 20
            }
          },
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
