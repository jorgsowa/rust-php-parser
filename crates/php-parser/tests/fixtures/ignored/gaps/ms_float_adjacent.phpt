===source===
<?php
$a = 1..2;
===errors >=8.5===
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected floating-point number ".2" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Float": 1.0
                },
                "span": {
                  "start": 11,
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
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 0.2
          },
          "span": {
            "start": 13,
            "end": 15
          }
        }
      },
      "span": {
        "start": 13,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
