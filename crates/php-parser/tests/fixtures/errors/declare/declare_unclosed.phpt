===source===
<?php declare(strict_types=1
===errors===
expected ')', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ')' or ',' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            ]
          ],
          "body": {
            "kind": "Error",
            "span": {
              "start": 28,
              "end": 28
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
