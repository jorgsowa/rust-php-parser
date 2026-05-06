===source===
<?php namespace;
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [],
            "kind": "Error",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "{" in Standard input code on line 1
