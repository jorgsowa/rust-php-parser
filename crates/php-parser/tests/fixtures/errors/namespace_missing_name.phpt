===source===
<?php namespace;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "{" in Standard input code on line 1
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
