===source===
<?php exit(
===errors===
expected expression, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting ')' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": "Error",
              "span": {
                "start": 11,
                "end": 11
              }
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
