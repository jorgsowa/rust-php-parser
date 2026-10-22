===source===
<?php function match() {}
===errors >=8.0===
cannot use 'match' as function name; it is reserved
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "match", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "match",
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
