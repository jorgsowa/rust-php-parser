===source===
<?php
$a = (int
)$y;
===errors===
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected variable "$y" in Standard input code on line 3
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
                          "start": 12,
                          "end": 15
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 11,
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
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "y"
          },
          "span": {
            "start": 17,
            "end": 19
          }
        }
      },
      "span": {
        "start": 17,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
