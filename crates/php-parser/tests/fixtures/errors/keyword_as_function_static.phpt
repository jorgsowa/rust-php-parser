===source===
<?php function static() {}
===errors===
cannot use 'static' as function name; it is reserved
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "static",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "static", expecting "(" in Standard input code on line 1
