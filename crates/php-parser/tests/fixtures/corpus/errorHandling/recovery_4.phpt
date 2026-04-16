===source===
<?php
abc;
1 + ;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "abc"
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              },
              "op": "Add",
              "right": {
                "kind": "Error",
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 16
          }
        }
      },
      "span": {
        "start": 11,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
