===source===
<?php declare(
===errors===
expected ')', found end of file
expected statement, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting identifier (T_STRING) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [],
          "body": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 14
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
