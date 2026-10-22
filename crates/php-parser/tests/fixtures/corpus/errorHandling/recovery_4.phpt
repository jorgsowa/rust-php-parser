===source===
<?php
abc;
1 + ;
===errors===
expected expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "abc"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 6,
                "end": 9
              }
            }
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
