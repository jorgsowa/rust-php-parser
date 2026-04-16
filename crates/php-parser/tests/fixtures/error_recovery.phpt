===source===
<?php
$x = ;
$y = 42;
echo $y;
===errors===
expected expression
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 20
          }
        }
      },
      "span": {
        "start": 13,
        "end": 21
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "y"
            },
            "span": {
              "start": 27,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 22,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 2
