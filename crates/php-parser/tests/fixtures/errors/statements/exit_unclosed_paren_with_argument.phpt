===source===
<?php exit(1
===errors===
expected ')', found end of file
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
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 11,
                "end": 12
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
