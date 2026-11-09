===source===
<?php 1 + 2 = $x;
===errors===
Cannot use expression as assignment target.
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=" in Standard input code on line 1
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 7
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
