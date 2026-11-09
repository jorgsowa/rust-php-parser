===source===
<?php function list() {}
===errors===
cannot use 'list' as function name; it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'list' (T_LIST), expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "list", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "list",
            "span": {
              "start": 15,
              "end": 19
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
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
