===source===
<?php
[] += 1;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token "+=" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              }
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
