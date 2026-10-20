===source===
<?php
list() .= 1;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token ".=", expecting "=" in Standard input code on line 2
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
                  "end": 12
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
