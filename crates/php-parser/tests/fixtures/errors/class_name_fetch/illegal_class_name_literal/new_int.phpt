===source===
<?php
new (1);
===errors <=7.4===
'new with an expression' requires PHP 8.0 or higher
Illegal class name
===errors >=8.0===
Illegal class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
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
                  "start": 10,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 13
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
