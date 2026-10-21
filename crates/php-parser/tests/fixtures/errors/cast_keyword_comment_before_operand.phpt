===source===
<?php
$a = (/* c */ int) $y;
===errors===
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected variable "$y" in Standard input code on line 2
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
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 23
                        }
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "y"
          },
          "span": {
            "start": 25,
            "end": 27
          }
        }
      },
      "span": {
        "start": 25,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
