===source===
<?php
new T
===errors===
expected ';' after expression
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
                  "Identifier": "T"
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "args": []
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
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
